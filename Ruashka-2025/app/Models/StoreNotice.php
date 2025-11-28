<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreNotice extends Model
{
    protected $table = 'store_notices';

    protected $fillable = [
        'store_id',
        'title',
        'content',
        'priority',
        'expires_at',
        'created_by',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function author()
    {
        return $this->belongsTo(StorePersonnel::class, 'created_by');
    }
}
