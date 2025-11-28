<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreAttendance extends Model
{
    protected $table = 'store_attendance';
    protected $fillable = [
        'store_id',
        'store_personnel_id',
        'date',
        'check_in',
        'check_out',
        'status',
        'notes',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function personnel()
    {
        return $this->belongsTo(StorePersonnel::class, 'store_personnel_id');
    }
}
