<?php

namespace App\Livewire\Sales;

use Livewire\Component;

use App\Models\Cliente;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

#[Title('Gestión de Clientes')]
class Customers extends Component
{
    use WithPagination;

    public $search = '';
    public $isModalOpen = false;
    public $isEditing = false;
    public $customerIdBeingEdited = null;

    // Form fields
    public $name;
    public $email;
    public $phone;
    public $address;
    public $document_number;

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'nullable|email', // Unique check handled manually for updates
        'document_number' => 'nullable', // Unique check handled manually for updates
    ];

    public function render()
    {
        $customers = Cliente::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('document_number', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.sales.customers', [
            'customers' => $customers,
        ]);
    }

    public function create()
    {
        $this->resetInputFields();
        $this->isEditing = false;
        $this->openModal();
    }

    public function edit($id)
    {
        $customer = Cliente::findOrFail($id);
        $this->customerIdBeingEdited = $id;
        $this->name = $customer->name;
        $this->email = $customer->email;
        $this->phone = $customer->phone;
        $this->address = $customer->address;
        $this->document_number = $customer->document_number;
        
        $this->isEditing = true;
        $this->openModal();
    }

    public function save()
    {
        $this->validate();

        // Manual unique check to handle updates correctly
        if ($this->email) {
            $existingEmail = Cliente::where('email', $this->email)
                ->when($this->isEditing, function ($query) {
                    return $query->where('id', '!=', $this->customerIdBeingEdited);
                })
                ->first();
            
            if ($existingEmail) {
                $this->addError('email', 'El email ya está registrado.');
                return;
            }
        }

        if ($this->document_number) {
            $existingDoc = Cliente::where('document_number', $this->document_number)
                ->when($this->isEditing, function ($query) {
                    return $query->where('id', '!=', $this->customerIdBeingEdited);
                })
                ->first();
            
            if ($existingDoc) {
                $this->addError('document_number', 'El DNI/RUC ya está registrado.');
                return;
            }
        }

        if ($this->isEditing) {
            $customer = Cliente::findOrFail($this->customerIdBeingEdited);
            $customer->update([
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'address' => $this->address,
                'document_number' => $this->document_number,
            ]);
            session()->flash('message', 'Cliente actualizado exitosamente.');
        } else {
            Cliente::create([
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'address' => $this->address,
                'document_number' => $this->document_number,
            ]);
            session()->flash('message', 'Cliente creado exitosamente.');
        }

        $this->closeModal();
        $this->resetInputFields();
    }

    public function delete($id)
    {
        Cliente::find($id)->delete();
        session()->flash('message', 'Cliente eliminado exitosamente.');
    }

    public function openModal()
    {
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->email = '';
        $this->phone = '';
        $this->address = '';
        $this->document_number = '';
        $this->customerIdBeingEdited = null;
        $this->resetErrorBag();
    }
}
