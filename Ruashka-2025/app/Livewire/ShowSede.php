<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Sede;

class ShowSede extends Component
{
    public $sede;
    public $sedeId;

    public function mount($id)
    {
        $this->sedeId = $id;
        $this->sede = Sede::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.show-sede');
    }
}
