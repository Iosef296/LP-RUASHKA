<?php

namespace App\Livewire\Sales;

use Livewire\Component;

use App\Models\Cliente;
use Livewire\Attributes\Title;

#[Title('Nuevo Cliente')]
class CustomerCreate extends Component
{
    public $name;
    public $email;
    public $phone;
    public $address;
    public $document_number;

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'nullable|email|unique:clientes,email',
        'document_number' => 'nullable|unique:clientes,document_number',
    ];

    public function save()
    {
        $this->validate();

        Cliente::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'document_number' => $this->document_number,
        ]);

        session()->flash('message', 'Cliente registrado exitosamente.');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.sales.customer-create');
    }
}
