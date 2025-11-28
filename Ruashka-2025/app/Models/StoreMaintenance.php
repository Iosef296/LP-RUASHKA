<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreMaintenance extends Model
{
    protected $table = 'store_maintenance';
    protected $fillable = [
        'store_id',
        'store_machine_id',
        'scheduled_date',
        'type',
        'description',
        'status',
        'performed_by',
    ];

    protected $casts = [
        'scheduled_date' => 'date',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function machine()
    {
        return $this->belongsTo(StoreMachine::class, 'store_machine_id');
    }

    public function performer()
    {
        return $this->belongsTo(StorePersonnel::class, 'performed_by');
    }
}
