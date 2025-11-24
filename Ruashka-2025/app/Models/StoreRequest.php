<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreRequest extends Model
{
    protected $table = 'store_requests';
    protected $fillable = [
        'store_id',
        'requester_id',
        'type',
        'details',
        'status',
        'approved_by',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function requester()
    {
        return $this->belongsTo(StorePersonnel::class, 'requester_id');
    }

    public function approver()
    {
        return $this->belongsTo(StorePersonnel::class, 'approved_by');
    }
}
