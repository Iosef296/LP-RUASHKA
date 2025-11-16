<?php

namespace App\Livewire\Store;

use App\Models\StoreAttendance;
use App\Models\StorePersonnel;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;

class Attendance extends Component
{
    use WithPagination;

    public $date;
    public $search = '';

    public function mount()
    {
        $this->date = Carbon::today()->format('Y-m-d');
    }

    public function render()
    {
        $personnel = StorePersonnel::query()
            ->where('store_id', 1)
            ->where('is_active', true)
            ->where(function ($query) {
                $query->where('first_name', 'like', '%' . $this->search . '%')
                      ->orWhere('last_name', 'like', '%' . $this->search . '%');
            })
            ->with(['store' => function ($query) {
            }])
            ->get()
            ->map(function ($person) {
                $attendance = StoreAttendance::where('store_personnel_id', $person->id)
                    ->where('date', $this->date)
                    ->first();
                $person->attendance = $attendance;
                return $person;
            });

        return view('livewire.store.attendance', [
            'personnel_list' => $personnel,
        ]);
    }

    public function checkIn($personnelId)
    {
        StoreAttendance::updateOrCreate(
            [
                'store_id' => 1, // TODO: Get actual store ID
                'store_personnel_id' => $personnelId,
                'date' => $this->date,
            ],
            [
                'check_in' => Carbon::now()->format('H:i:s'),
                'status' => 'present',
            ]
        );
    }

    public function checkOut($personnelId)
    {
        $attendance = StoreAttendance::where('store_personnel_id', $personnelId)
            ->where('date', $this->date)
            ->first();

        if ($attendance) {
            $attendance->update([
                'check_out' => Carbon::now()->format('H:i:s'),
            ]);
        }
    }

    public function updateStatus($personnelId, $status)
    {
        StoreAttendance::updateOrCreate(
            [
                'store_id' => 1, // TODO: Get actual store ID
                'store_personnel_id' => $personnelId,
                'date' => $this->date,
            ],
            [
                'status' => $status,
            ]
        );
    }
}
