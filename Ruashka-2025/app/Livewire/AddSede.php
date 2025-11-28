<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Sede;

class AddSede extends Component
{
    public $nombre, $codigo, $direccion, $ciudad, $departamento;
    public $telefono, $email, $encargado, $capacidad;
    public $tipo, $estado = 'activa', $observaciones;

    protected $rules = [
        'nombre' => 'required|string|max:255',
        'codigo' => 'required|unique:sedes,codigo',
        'direccion' => 'required',
        'ciudad' => 'required',
        'departamento' => 'required',
        'telefono' => 'required',
        'tipo' => 'required',
        'capacidad' => 'required|numeric|min:0',
        'estado' => 'required',
    ];

    public function store()
    {
        $this->validate();

        Sede::create([
            'nombre' => $this->nombre,
            'codigo' => $this->codigo,
            'direccion' => $this->direccion,
            'ciudad' => $this->ciudad,
            'departamento' => $this->departamento,
            'telefono' => $this->telefono,
            'email' => $this->email,
            'encargado' => $this->encargado,
            'capacidad' => $this->capacidad,
            'tipo' => $this->tipo,
            'estado' => $this->estado,
            'observaciones' => $this->observaciones,
        ]);

        session()->flash('message', 'Sede agregada exitosamente.');

        return redirect()->route('sede.index');
    }

    public function render()
    {
        return view('livewire.add-sede');
    }
}
