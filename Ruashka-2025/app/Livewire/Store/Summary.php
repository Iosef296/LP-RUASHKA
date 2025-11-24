<?php

namespace App\Livewire\Store;

use Livewire\Component;

use App\Models\StorePersonnel;
use App\Models\StoreAttendance;
use App\Models\StoreIncident;
use App\Models\StoreRequest;
use App\Models\StoreMachine;
use App\Models\StoreMaintenance;
use App\Models\StoreNotice;
use Carbon\Carbon;

class Summary extends Component
{
    public function render()
    {
        $storeId = 1; // Dynamic store ID to be implemented later

        // Personnel Stats
        $totalPersonnel = StorePersonnel::where('store_id', $storeId)->where('is_active', true)->count();
        $personnelPresent = StoreAttendance::where('store_id', $storeId)
            ->where('date', Carbon::today())
            ->whereNotNull('check_in')
            ->whereNull('check_out')
            ->count();

        // Incidents Stats
        $openIncidents = StoreIncident::where('store_id', $storeId)
            ->whereIn('status', ['open', 'investigating'])
            ->count();
        $criticalIncidents = StoreIncident::where('store_id', $storeId)
            ->whereIn('status', ['open', 'investigating'])
            ->where('severity', 'critical') // Changed from priority to severity
            ->count();

        // Requests Stats
        $pendingRequests = StoreRequest::where('store_id', $storeId)
            ->where('status', 'pending')
            ->count();

        // Maintenance Stats
        $maintenanceCount = StoreMachine::where('store_id', $storeId)
            ->where('status', 'maintenance')
            ->count();
        
        $scheduledMaintenance = StoreMaintenance::where('store_id', $storeId)
            ->where('scheduled_date', Carbon::today())
            ->where('status', 'pending')
            ->count();

        // Recent Activity
        $recentIncidents = StoreIncident::where('store_id', $storeId)
            ->latest()
            ->take(3)
            ->get()
            ->map(function ($item) {
                $item->type = 'incident';
                return $item;
            });

        $recentRequests = StoreRequest::where('store_id', $storeId)
            ->latest()
            ->take(3)
            ->get()
            ->map(function ($item) {
                $item->type = 'request';
                return $item;
            });

        $recentNotices = StoreNotice::where('store_id', $storeId)
            ->latest()
            ->take(3)
            ->get()
            ->map(function ($item) {
                $item->type = 'notice';
                return $item;
            });

        $recentActivity = $recentIncidents->concat($recentRequests)->concat($recentNotices)
            ->sortByDesc('created_at')
            ->take(5);

        return view('livewire.store.summary', [
            'totalPersonnel' => $totalPersonnel,
            'personnelPresent' => $personnelPresent,
            'openIncidents' => $openIncidents,
            'criticalIncidents' => $criticalIncidents,
            'pendingRequests' => $pendingRequests,
            'maintenanceCount' => $maintenanceCount + $scheduledMaintenance,
            'recentActivity' => $recentActivity,
        ]);
    }
}
