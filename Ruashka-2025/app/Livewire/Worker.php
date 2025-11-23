<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Worker as WorkerModel;
use App\Models\Role;
use App\Models\Sede;

class Worker extends Component
{
    public $editingWorkerId = null;
    public $editForm = [];

public function editWorker($id)
{
    $worker = WorkerModel::findOrFail($id);
    $this->editingWorkerId = $id;

    $this->editForm = [
        'nombre' => $worker->nombre,
        'dni' => $worker->dni,
        'email' => $worker->email,
        'telefono' => $worker->telefono,
        'genero' => $worker->genero,
        'role_id' => $worker->role_id,  // ← Asegúrate que esté esto
        'sede_id' => $worker->sede_id,  // ← Y esto
        'salario' => $worker->salario,
        'tipo_contrato' => $worker->tipo_contrato,
        'estado' => $worker->estado,
    ];
}
    public function updateWorker()
    {
        $this->validate([
            'editForm.nombre' => 'required',
            'editForm.dni' => 'required',
            'editForm.email' => 'required|email',
            'editForm.telefono' => 'required',
            'editForm.role_id' => 'required|exists:roles,id',
            'editForm.sede_id' => 'required|exists:sedes,id',
            'editForm.salario' => 'required|numeric',
        ]);

        $worker = WorkerModel::findOrFail($this->editingWorkerId);
        $worker->update($this->editForm);

        session()->flash('message', 'Trabajador actualizado exitosamente.');
        $this->cancelEdit();
    }

    public function cancelEdit()
    {
        $this->editingWorkerId = null;
        $this->editForm = [];
    }

    public function deleteWorker($id)
    {
        WorkerModel::findOrFail($id)->delete();
        session()->flash('message', 'Trabajador eliminado exitosamente.');
    }

    public function render()
{
    $workers = WorkerModel::with(['role', 'sede'])->get();
    $roles = Role::where('estado', 'activo')->get();
    $sedes = Sede::where('estado', 'activa')->get();

    return view('livewire.worker', [
        'workers' => $workers,
        'roles' => $roles,
        'sedes' => $sedes
    ]);
}
}
