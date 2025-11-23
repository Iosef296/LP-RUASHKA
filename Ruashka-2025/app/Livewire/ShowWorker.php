<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Worker;

class ShowWorker extends Component
{
    public $worker;
    public $workerId;

    public function mount($id)
    {
        $this->workerId = $id;
        $this->worker = Worker::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.show-worker');
    }
}
