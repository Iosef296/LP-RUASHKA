<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Role;

class Roles extends Component
{
    public $editingRoleId = null;
    public $editForm = [];

    public function editRole($id)
    {
        $role = Role::findOrFail($id);
        $this->editingRoleId = $id;

        $this->editForm = [
            'nombre' => $role->nombre,
            'codigo' => $role->codigo,
            'descripcion' => $role->descripcion,
            'nivel' => $role->nivel,
            'estado' => $role->estado,
        ];
    }

    public function updateRole()
    {
        $role = Role::findOrFail($this->editingRoleId);
        $role->update($this->editForm);

        session()->flash('message', 'Rol actualizado exitosamente.');
        $this->cancelEdit();
    }

    public function cancelEdit()
    {
        $this->editingRoleId = null;
        $this->editForm = [];
    }

    public function deleteRole($id)
    {
        Role::findOrFail($id)->delete();
        session()->flash('message', 'Rol eliminado exitosamente.');
    }

    public function render()
    {
        $roles = Role::all();

        return view('livewire.roles', [
            'roles' => $roles
        ]);
    }
}
