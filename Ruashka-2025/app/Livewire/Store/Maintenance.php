<?php

namespace App\Livewire\Store;

use App\Models\StoreMachine;
use App\Models\StoreMaintenance;
use App\Models\StoreMachineFault;
use Livewire\Component;
use Livewire\WithPagination;

class Maintenance extends Component
{
    use WithPagination;

    public $activeTab = 'machines';
    public $search = '';
    public $showModal = false;
    public $modalType = '';

    public $machine_name;
    public $serial_number;
    public $machine_status = 'operational';

    public $selected_machine_id;
    public $scheduled_date;
    public $maintenance_type = 'preventive';
    public $maintenance_description;

    public $fault_description;
    public $fault_priority = 'medium';

    public function render()
    {
        $machines = [];
        $maintenances = [];
        $faults = [];

        if ($this->activeTab === 'machines') {
            $machines = StoreMachine::query()
                ->where('store_id', 1)
                ->where('name', 'like', '%' . $this->search . '%')
                ->paginate(10);
        } elseif ($this->activeTab === 'scheduled') {
            $maintenances = StoreMaintenance::query()
                ->where('store_id', 1)
                ->with('machine')
                ->paginate(10);
        } elseif ($this->activeTab === 'faults') {
            $faults = StoreMachineFault::query()
                ->where('store_id', 1)
                ->with('machine')
                ->paginate(10);
        }

        return view('livewire.store.maintenance', [
            'machines' => $machines,
            'maintenances' => $maintenances,
            'faults' => $faults,
            'all_machines' => StoreMachine::where('store_id', 1)->get(),
        ]);
    }

    public function setTab($tab)
    {
        $this->activeTab = $tab;
        $this->resetPage();
    }

    public function openModal($type)
    {
        $this->modalType = $type;
        $this->showModal = true;
        $this->resetInputFields();
    }

    public function storeMachine()
    {
        $this->validate([
            'machine_name' => 'required|string',
            'serial_number' => 'nullable|string',
        ]);

        StoreMachine::create([
            'store_id' => 1,
            'name' => $this->machine_name,
            'serial_number' => $this->serial_number,
            'status' => $this->machine_status,
        ]);

        $this->showModal = false;
        $this->resetInputFields();
    }

    public function storeMaintenance()
    {
        $this->validate([
            'selected_machine_id' => 'required|exists:store_machines,id',
            'scheduled_date' => 'required|date',
            'maintenance_type' => 'required|string',
        ]);

        StoreMaintenance::create([
            'store_id' => 1,
            'store_machine_id' => $this->selected_machine_id,
            'scheduled_date' => $this->scheduled_date,
            'type' => $this->maintenance_type,
            'description' => $this->maintenance_description,
            'status' => 'pending',
        ]);

        $this->showModal = false;
        $this->resetInputFields();
    }

    public function storeFault()
    {
        $this->validate([
            'selected_machine_id' => 'required|exists:store_machines,id',
            'fault_description' => 'required|string',
        ]);

        StoreMachineFault::create([
            'store_id' => 1,
            'store_machine_id' => $this->selected_machine_id,
            'reported_at' => now(),
            'description' => $this->fault_description,
            'priority' => $this->fault_priority,
            'status' => 'open',
        ]);

        $machine = StoreMachine::find($this->selected_machine_id);
        $machine->update(['status' => 'broken']);

        $this->showModal = false;
        $this->resetInputFields();
    }

    public function editMachine($id)
    {
        $machine = StoreMachine::findOrFail($id);
        $this->selected_machine_id = $id;
        $this->machine_name = $machine->name;
        $this->serial_number = $machine->serial_number;
        $this->machine_status = $machine->status;

        $this->modalType = 'machine_edit';
        $this->showModal = true;
    }

    public function updateMachine()
    {
        $this->validate([
            'machine_name' => 'required|string',
            'serial_number' => 'nullable|string',
        ]);

        $machine = StoreMachine::findOrFail($this->selected_machine_id);
        $machine->update([
            'name' => $this->machine_name,
            'serial_number' => $this->serial_number,
            'status' => $this->machine_status,
        ]);

        $this->showModal = false;
        $this->resetInputFields();
    }

    public function deleteMachine($id)
    {
        StoreMachine::find($id)->delete();
    }

    public function editMaintenance($id)
    {
        $maintenance = StoreMaintenance::findOrFail($id);
        $this->selected_machine_id = $maintenance->store_machine_id;
        $this->scheduled_date = $maintenance->scheduled_date->format('Y-m-d');
        $this->maintenance_type = $maintenance->type;
        $this->maintenance_description = $maintenance->description;

        $this->maintenanceId = $id;

        $this->modalType = 'maintenance_edit';
        $this->showModal = true;
    }

    public $maintenanceId;

    public function updateMaintenance()
    {
        $this->validate([
            'selected_machine_id' => 'required|exists:store_machines,id',
            'scheduled_date' => 'required|date',
            'maintenance_type' => 'required|string',
        ]);

        $maintenance = StoreMaintenance::findOrFail($this->maintenanceId);
        $maintenance->update([
            'store_machine_id' => $this->selected_machine_id,
            'scheduled_date' => $this->scheduled_date,
            'type' => $this->maintenance_type,
            'description' => $this->maintenance_description,
        ]);

        $this->showModal = false;
        $this->resetInputFields();
    }

    public function deleteMaintenance($id)
    {
        StoreMaintenance::find($id)->delete();
    }

    public function editFault($id)
    {
        $fault = StoreMachineFault::findOrFail($id);
        $this->selected_machine_id = $fault->store_machine_id;
        $this->fault_description = $fault->description;
        $this->fault_priority = $fault->priority;

        $this->faultId = $id;

        $this->modalType = 'fault_edit';
        $this->showModal = true;
    }

    public $faultId;

    public function updateFault()
    {
        $this->validate([
            'selected_machine_id' => 'required|exists:store_machines,id',
            'fault_description' => 'required|string',
        ]);

        $fault = StoreMachineFault::findOrFail($this->faultId);
        $fault->update([
            'store_machine_id' => $this->selected_machine_id,
            'description' => $this->fault_description,
            'priority' => $this->fault_priority,
        ]);

        $this->showModal = false;
        $this->resetInputFields();
    }

    public function deleteFault($id)
    {
        StoreMachineFault::find($id)->delete();
    }

    private function resetInputFields()
    {
        $this->machine_name = '';
        $this->serial_number = '';
        $this->machine_status = 'operational';
        $this->selected_machine_id = '';
        $this->scheduled_date = '';
        $this->maintenance_type = 'preventive';
        $this->maintenance_description = '';
        $this->fault_description = '';
        $this->fault_priority = 'medium';
        $this->maintenanceId = null;
        $this->faultId = null;
    }
}
