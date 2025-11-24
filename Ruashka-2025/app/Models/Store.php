<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $table = 'stores';

    protected $fillable = [
        'name',
        'address',
        'phone',
        'manager_name',
        'settings',
    ];

    protected $casts = [
        'settings' => 'array',
    ];

    public function personnel()
    {
        return $this->hasMany(StorePersonnel::class);
    }
}
