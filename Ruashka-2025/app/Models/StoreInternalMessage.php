<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreInternalMessage extends Model
{
    protected $table = 'store_internal_messages';

    protected $fillable = [
        'store_id',
        'sender_id',
        'recipient_id',
        'message',
        'is_read',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function sender()
    {
        return $this->belongsTo(StorePersonnel::class, 'sender_id');
    }

    public function recipient()
    {
        return $this->belongsTo(StorePersonnel::class, 'recipient_id');
    }
}
