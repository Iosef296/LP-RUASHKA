<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreShift extends Model
{
    protected $table = 'store_shifts';
    protected $fillable = [
        'store_id',
        'name',
        'start_time',
        'end_time',
        'days_of_week',
    ];

    protected $casts = [
        'days_of_week' => 'array',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
