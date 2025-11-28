<?php

namespace App\Livewire\Store;

use App\Models\StoreAccessLog;
use Livewire\Component;
use Livewire\WithPagination;

class AccessLogs extends Component
{
    use WithPagination;

    public $search = '';

    public function render()
    {
        $logs = StoreAccessLog::query()
            ->where('store_id', 1)
            ->where(function ($query) {
                $query->where('action', 'like', '%' . $this->search . '%')
                      ->orWhere('details', 'like', '%' . $this->search . '%');
            })
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('livewire.store.access-logs', [
            'logs' => $logs,
        ]);
    }
}
