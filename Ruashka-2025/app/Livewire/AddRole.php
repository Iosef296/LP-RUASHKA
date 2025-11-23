<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Role;

class AddRole extends Component
{
    public $nombre, $codigo, $descripcion, $nivel, $departamento;
    public $estado = 'activo', $observaciones;
    public $permisos = [
        'trabajadores' => ['ver' => false, 'crear' => false, 'editar' => false, 'eliminar' => false],
        'sedes' => ['ver' => false, 'crear' => false, 'editar' => false, 'eliminar' => false],
        'roles' => ['ver' => false, 'crear' => false, 'editar' => false, 'eliminar' => false],
        'reportes' => ['ver' => false, 'generar' => false, 'exportar' => false],
    ];

    protected $rules = [
        'nombre' => 'required|string|max:255',
        'codigo' => 'required|unique:roles,codigo',
        'descripcion' => 'required',
        'nivel' => 'required',
        'estado' => 'required',
    ];

    public function store()
    {
        $this->validate();

        Role::create([
            'nombre' => $this->nombre,
            'codigo' => $this->codigo,
            'descripcion' => $this->descripcion,
            'nivel' => $this->nivel,
            'permisos' => $this->permisos,
            'departamento' => $this->departamento,
            'estado' => $this->estado,
            'observaciones' => $this->observaciones,
            'usuarios_count' => 0,
        ]);

        session()->flash('message', 'Rol creado exitosamente.');

        return redirect()->route('role.index');
    }

    public function render()
    {
        return view('livewire.add-role');
    }
}
