<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Worker;
use App\Models\Role;
use App\Models\Sede;

class EditWorker extends Component
{
    public $workerId;
    public $nombre, $dni, $email, $telefono, $fecha_nacimiento, $genero, $direccion;
    public $role_id, $sede_id, $fecha_ingreso, $salario, $tipo_contrato, $estado;
    public $observaciones;

    protected function rules()
    {
        return [
            'nombre' => 'required|string|max:255',
            'dni' => 'required|unique:workers,dni,' . $this->workerId,
            'email' => 'required|email|unique:workers,email,' . $this->workerId,
            'telefono' => 'required',
            'fecha_nacimiento' => 'required|date',
            'genero' => 'required',
            'role_id' => 'required|exists:roles,id',
            'sede_id' => 'required|exists:sedes,id',
            'fecha_ingreso' => 'required|date',
            'salario' => 'required|numeric',
            'tipo_contrato' => 'required',
            'estado' => 'required',
        ];
    }

    public function mount($id)
    {
        $this->workerId = $id;
        $worker = Worker::findOrFail($id);

        $this->nombre = $worker->nombre;
        $this->dni = $worker->dni;
        $this->email = $worker->email;
        $this->telefono = $worker->telefono;
        $this->fecha_nacimiento = $worker->fecha_nacimiento;
        $this->genero = $worker->genero;
        $this->direccion = $worker->direccion;
        $this->role_id = $worker->role_id;
        $this->sede_id = $worker->sede_id;
        $this->fecha_ingreso = $worker->fecha_ingreso;
        $this->salario = $worker->salario;
        $this->tipo_contrato = $worker->tipo_contrato;
        $this->estado = $worker->estado;
        $this->observaciones = $worker->observaciones;
    }

    public function incrementSalario()
    {
        $this->salario = ($this->salario ?? 0) + 50;
    }

    public function decrementSalario()
    {
        $this->salario = max(0, ($this->salario ?? 0) - 50);
    }

    public function update()
    {
        $this->validate();

        $worker = Worker::findOrFail($this->workerId);
        $worker->update([
            'nombre' => $this->nombre,
            'dni' => $this->dni,
            'email' => $this->email,
            'telefono' => $this->telefono,
            'fecha_nacimiento' => $this->fecha_nacimiento,
            'genero' => $this->genero,
            'direccion' => $this->direccion,
            'role_id' => $this->role_id,
            'sede_id' => $this->sede_id,
            'fecha_ingreso' => $this->fecha_ingreso,
            'salario' => $this->salario,
            'tipo_contrato' => $this->tipo_contrato,
            'estado' => $this->estado,
            'observaciones' => $this->observaciones,
        ]);

        session()->flash('message', 'Trabajador actualizado exitosamente.');

        return redirect()->route('worker.show', $this->workerId);
    }

    public function render()
    {
        $roles = Role::where('estado', 'activo')->get();
        $sedes = Sede::where('estado', 'activa')->get();

        return view('livewire.edit-worker', [
            'roles' => $roles,
            'sedes' => $sedes
        ]);
    }
}
