<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreMachine extends Model
{
    protected $table = 'store_machines';
    protected $fillable = [
        'store_id',
        'name',
        'serial_number',
        'status',
        'last_maintenance',
        'next_maintenance',
    ];

    protected $casts = [
        'last_maintenance' => 'date',
        'next_maintenance' => 'date',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function maintenance()
    {
        return $this->hasMany(StoreMaintenance::class);
    }

    public function faults()
    {
        return $this->hasMany(StoreMachineFault::class);
    }
}
