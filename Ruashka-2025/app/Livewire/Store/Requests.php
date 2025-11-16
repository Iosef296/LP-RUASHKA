<?php

namespace App\Livewire\Store;

use App\Models\StoreRequest;
use App\Models\StorePersonnel;
use Livewire\Component;
use Livewire\WithPagination;

class Requests extends Component
{
    use WithPagination;

    public $search = '';
    public $showModal = false;

    public $type;
    public $details;
    public $requester_id;

    protected $rules = [
        'type' => 'required|string|max:255',
        'details' => 'required|string',
        'requester_id' => 'required|exists:store_personnel,id',
    ];

    public function render()
    {
        $requests = StoreRequest::query()
            ->where('store_id', 1)
            ->where('type', 'like', '%' . $this->search . '%')
            ->with(['requester', 'approver'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.store.requests', [
            'requests' => $requests,
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

        StoreRequest::create([
            'store_id' => 1,
            'requester_id' => $this->requester_id,
            'type' => $this->type,
            'details' => $this->details,
            'status' => 'pending',
        ]);

        $this->showModal = false;
        $this->resetInputFields();
    }

    public function updateStatus($id, $status)
    {
        $request = StoreRequest::find($id);

        $request->update([
            'status' => $status,
        ]);
    }

    public $requestId;
    public $editMode = false;

    public function edit($id)
    {
        $request = StoreRequest::findOrFail($id);
        $this->requestId = $id;
        $this->type = $request->type;
        $this->details = $request->details;
        $this->requester_id = $request->requester_id;

        $this->editMode = true;
        $this->showModal = true;
    }

    public function update()
    {
        $this->validate();

        $request = StoreRequest::findOrFail($this->requestId);
        $request->update([
            'type' => $this->type,
            'details' => $this->details,
            'requester_id' => $this->requester_id,
        ]);

        $this->showModal = false;
        $this->resetInputFields();
    }

    public function delete($id)
    {
        StoreRequest::find($id)->delete();
    }

    private function resetInputFields()
    {
        $this->type = '';
        $this->details = '';
        $this->requester_id = '';
        $this->requestId = null;
        $this->editMode = false;
    }
}
