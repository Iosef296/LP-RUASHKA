<?php

namespace App\Livewire\Store;

use App\Models\StorePersonnel;
use Livewire\Component;
use Livewire\WithPagination;

class Personnel extends Component
{
    use WithPagination;

    public $search = '';
    public $showModal = false;
    public $editMode = false;
    public $personnelId;

    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $hire_date;
    public $is_active = true;
    public $selectedRoles = [];

    protected $rules = [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'nullable|email|max:255',
        'phone' => 'nullable|string|max:20',
        'hire_date' => 'nullable|date',
        'is_active' => 'boolean',
    ];

    public function render()
    {
        $personnel = StorePersonnel::query()
            ->where('first_name', 'like', '%' . $this->search . '%')
            ->orWhere('last_name', 'like', '%' . $this->search . '%')
            ->with('roles')
            ->paginate(10);

        return view('livewire.store.personnel', [
            'personnel' => $personnel,
            'roles' => \App\Models\StoreRole::where('store_id', 1)->get(),
        ]);
    }

    public function create()
    {
        $this->resetInputFields();
        $this->showModal = true;
        $this->editMode = false;
    }

    public function store()
    {
        $this->validate();

        $personnel = StorePersonnel::create([
            'store_id' => 1,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'hire_date' => $this->hire_date,
            'is_active' => $this->is_active,
        ]);

        if (!empty($this->selectedRoles)) {
            $personnel->roles()->sync($this->selectedRoles);
        }

        $this->showModal = false;
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $personnel = StorePersonnel::findOrFail($id);
        $this->personnelId = $id;
        $this->first_name = $personnel->first_name;
        $this->last_name = $personnel->last_name;
        $this->email = $personnel->email;
        $this->phone = $personnel->phone;
        $this->hire_date = $personnel->hire_date ? $personnel->hire_date->format('Y-m-d') : null;
        $this->is_active = $personnel->is_active;
        $this->selectedRoles = $personnel->roles->pluck('id')->toArray();

        $this->showModal = true;
        $this->editMode = true;
    }

    public function update()
    {
        $this->validate();

        $personnel = StorePersonnel::findOrFail($this->personnelId);
        $personnel->update([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'hire_date' => $this->hire_date,
            'is_active' => $this->is_active,
        ]);

        if (isset($this->selectedRoles)) {
            $personnel->roles()->sync($this->selectedRoles);
        }

        $this->showModal = false;
        $this->resetInputFields();
    }

    public function delete($id)
    {
        StorePersonnel::find($id)->delete();
    }

    private function resetInputFields()
    {
        $this->first_name = '';
        $this->last_name = '';
        $this->email = '';
        $this->phone = '';
        $this->hire_date = '';
        $this->is_active = true;
        $this->personnelId = null;
        $this->selectedRoles = [];
    }
}
