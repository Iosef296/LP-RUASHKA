<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreMachineFault extends Model
{
    protected $table = 'store_machine_faults';
    protected $fillable = [
        'store_id',
        'store_machine_id',
        'reported_at',
        'reported_by',
        'description',
        'priority',
        'status',
        'resolved_at',
    ];

    protected $casts = [
        'reported_at' => 'datetime',
        'resolved_at' => 'datetime',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function machine()
    {
        return $this->belongsTo(StoreMachine::class, 'store_machine_id');
    }

    public function reporter()
    {
        return $this->belongsTo(StorePersonnel::class, 'reported_by');
    }
}
