<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreAccessLog extends Model
{
    protected $table = 'store_access_logs';
    protected $fillable = [
        'store_id',
        'user_id',
        'action',
        'details',
        'ip_address',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
