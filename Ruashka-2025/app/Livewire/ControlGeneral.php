<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Sede;
use App\Models\Indicador;
use App\Models\PlanEstrategico;
use App\Models\Justificacion;
use App\Models\Auditoria;
use App\Models\ControlCalidad;
use App\Models\GastoOperativo;

use Flux\Flux;

class ControlGeneral extends Component
{
    public $editingType = null;
    public $editingId = null;
    public $form = [];

    protected $listeners = ['confirmDelete'];

    public function rules()
    {
        $rules = [];
        
        switch ($this->editingType) {
            case 'sede':
                $rules = [
                    'form.ubicacion' => 'required|string',
                    'form.organigrama' => 'nullable|url',
                ];
                break;
            case 'indicador':
                $rules = [
                    'form.tipo' => 'required|string',
                    'form.descripcion' => 'required|string',
                    'form.metas' => 'required|string',
                    'form.valor_actual' => 'required|string',
                    'form.porcentaje_cumplimiento' => 'required|numeric|min:0|max:100',
                    'form.fecha_actual' => 'required|date',
                ];
                break;
            case 'plan':
                $rules = [
                    'form.nombre' => 'required|string',
                    'form.objetivos' => 'required|string',
                    'form.fecha_inicio' => 'required|date',
                    'form.fecha_final' => 'required|date|after_or_equal:form.fecha_inicio',
                    'form.estado' => 'required|string',
                ];
                break;
            case 'justificacion':
                $rules = [
                    'form.asunto' => 'required|string',
                    'form.descripcion' => 'required|string',
                ];
                break;
            case 'auditoria':
                $rules = [
                    'form.area' => 'required|string',
                    'form.fecha' => 'required|date',
                    'form.resultado' => 'required|string',
                    'form.observaciones' => 'nullable|string',
                ];
                break;
            case 'control':
                $rules = [
                    'form.fecha_control' => 'required|date',
                    'form.resultado' => 'required|string',
                ];
                break;
            case 'gasto':
                $rules = [
                    'form.categoria' => 'required|string',
                    'form.desembolso' => 'required|numeric|min:0',
                ];
                break;
        }
        
        return $rules;
    }

    public function edit($type, $id)
    {
        $this->editingType = $type;
        $this->editingId = $id;

        $model = $this->getModel($type, $id);
        $this->form = $model->toArray();
        
        Flux::modal('edit-modal')->show();
    }

    public function create($type)
    {
        $this->editingType = $type;
        $this->editingId = null;
        $this->form = []; // Reset form
        
        Flux::modal('edit-modal')->show();
    }

    public function save()
    {
        $validatedData = $this->validate();
        $formData = $validatedData['form'];

        if ($this->editingId) {
            $model = $this->getModel($this->editingType, $this->editingId);
            $model->update($formData);
        } else {
            $class = $this->getModelClass($this->editingType);
            $class::create($formData);
        }

        $this->form = [];
        Flux::modal('edit-modal')->close();
    }

    public function cancel()
    {
        $this->form = [];
        Flux::modal('edit-modal')->close();
    }

    public function delete($type, $id)
    {
        $model = $this->getModel($type, $id);
        $model->delete();
    }

    private function getModel($type, $id)
    {
        $class = $this->getModelClass($type);
        return $class::findOrFail($id);
    }

    private function getModelClass($type)
    {
        return match ($type) {
            'sede' => Sede::class,
            'indicador' => Indicador::class,
            'plan' => PlanEstrategico::class,
            'justificacion' => Justificacion::class,
            'auditoria' => Auditoria::class,
            'control' => ControlCalidad::class,
            'gasto' => GastoOperativo::class,
        };
    }

    public function render()
    {
        return view('livewire.control-general', [
            'sedes' => Sede::all(),
            'indicadores' => Indicador::all(),
            'planes' => PlanEstrategico::all(),
            'justificaciones' => Justificacion::all(),
            'auditorias' => Auditoria::all(),
            'controles' => ControlCalidad::all(),
            'gastos' => GastoOperativo::all(),
        ]);
    }
}
