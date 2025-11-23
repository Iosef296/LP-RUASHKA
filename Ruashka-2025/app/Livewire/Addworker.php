<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Worker;
use App\Models\Role;
use App\Models\Sede;

class Addworker extends Component
{
    public $nombre, $dni, $email, $telefono, $fecha_nacimiento, $genero, $direccion;
    public $role_id, $sede_id, $fecha_ingreso, $salario, $tipo_contrato, $estado = 'activo';
    public $observaciones;

    protected $rules = [
        'nombre' => 'required|string|max:255',
        'dni' => 'required|unique:workers,dni',
        'email' => 'required|email|unique:workers,email',
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

    public function incrementSalario()
    {
        $this->salario = ($this->salario ?? 0) + 50;
    }

    public function decrementSalario()
    {
        $this->salario = max(0, ($this->salario ?? 0) - 50);
    }

    public function store()
    {
        $this->validate();

        Worker::create([
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

        session()->flash('message', 'Trabajador agregado exitosamente.');

        return redirect()->route('worker.index');
    }

    public function render()
    {
        $roles = Role::where('estado', 'activo')->get();
        $sedes = Sede::where('estado', 'activa')->get();

        return view('livewire.addworker', [
            'roles' => $roles,
            'sedes' => $sedes
        ]);
    }
}
