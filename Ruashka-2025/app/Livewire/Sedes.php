<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Sede;

class Sedes extends Component
{
    public $editingSedeId = null;
    public $editForm = [];

    public function editSede($id)
    {
        $sede = Sede::findOrFail($id);
        $this->editingSedeId = $id;

        $this->editForm = [
            'nombre' => $sede->nombre,
            'codigo' => $sede->codigo,
            'ciudad' => $sede->ciudad,
            'tipo' => $sede->tipo,
            'encargado' => $sede->encargado,
            'estado' => $sede->estado,
        ];
    }

    public function updateSede()
    {
        $sede = Sede::findOrFail($this->editingSedeId);
        $sede->update($this->editForm);

        session()->flash('message', 'Sede actualizada exitosamente.');
        $this->cancelEdit();
    }

    public function cancelEdit()
    {
        $this->editingSedeId = null;
        $this->editForm = [];
    }

    public function deleteSede($id)
    {
        Sede::findOrFail($id)->delete();
        session()->flash('message', 'Sede eliminada exitosamente.');
    }

    public function render()
    {
        $sedes = Sede::all();

        return view('livewire.sedes', [
            'sedes' => $sedes
        ]);
    }
}
