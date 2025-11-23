<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Role;

class ShowRole extends Component
{
    public $role;
    public $roleId;

    public function mount($id)
    {
        $this->roleId = $id;
        $this->role = Role::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.show-role');
    }
}
