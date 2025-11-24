<?php

namespace App\Livewire\Store;

use App\Models\StoreIncident;
use App\Models\StorePersonnel;
use Livewire\Component;
use Livewire\WithPagination;

class Incidents extends Component
{
    use WithPagination;

    public $search = '';
    public $showModal = false;

    public $title;
    public $description;
    public $occurred_at;
    public $severity = 'low';
    public $reported_by;

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'occurred_at' => 'required|date',
        'severity' => 'required|string',
        'reported_by' => 'nullable|exists:store_personnel,id',
    ];

    public function render()
    {
        $incidents = StoreIncident::query()
            ->where('store_id', 1)
            ->where('title', 'like', '%' . $this->search . '%')
            ->with('reporter')
            ->orderBy('occurred_at', 'desc')
            ->paginate(10);

        return view('livewire.store.incidents', [
            'incidents' => $incidents,
            'personnel' => StorePersonnel::where('store_id', 1)->get(),
        ]);
    }

    public function create()
    {
        $this->resetInputFields();
        $this->showModal = true;
    }

    public function store()
    {
        $this->validate();

        StoreIncident::create([
            'store_id' => 1,
            'title' => $this->title,
            'description' => $this->description,
            'occurred_at' => $this->occurred_at,
            'severity' => $this->severity,
            'reported_by' => $this->reported_by,
            'status' => 'open',
        ]);

        $this->showModal = false;
        $this->resetInputFields();
    }

    public function updateStatus($id, $status)
    {
        $incident = StoreIncident::find($id);
        $incident->update(['status' => $status]);
    }

    public $incidentId;
    public $editMode = false;

    public function edit($id)
    {
        $incident = StoreIncident::findOrFail($id);
        $this->incidentId = $id;
        $this->title = $incident->title;
        $this->description = $incident->description;
        $this->occurred_at = $incident->occurred_at->format('Y-m-d\TH:i');
        $this->severity = $incident->severity;
        $this->reported_by = $incident->reported_by;

        $this->editMode = true;
        $this->showModal = true;
    }

    public function update()
    {
        $this->validate();

        $incident = StoreIncident::findOrFail($this->incidentId);
        $incident->update([
            'title' => $this->title,
            'description' => $this->description,
            'occurred_at' => $this->occurred_at,
            'severity' => $this->severity,
            'reported_by' => $this->reported_by,
        ]);

        $this->showModal = false;
        $this->resetInputFields();
    }

    public function delete($id)
    {
        StoreIncident::find($id)->delete();
    }

    private function resetInputFields()
    {
        $this->title = '';
        $this->description = '';
        $this->occurred_at = now()->format('Y-m-d\TH:i');
        $this->severity = 'low';
        $this->reported_by = '';
        $this->incidentId = null;
        $this->editMode = false;
    }
}
