<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreIncident extends Model
{
    protected $table = 'store_incidents';
    protected $fillable = [
        'store_id',
        'title',
        'description',
        'occurred_at',
        'severity',
        'reported_by',
        'status',
    ];

    protected $casts = [
        'occurred_at' => 'datetime',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function reporter()
    {
        return $this->belongsTo(StorePersonnel::class, 'reported_by');
    }
}
