<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StorePersonnel extends Model
{
    protected $table = 'store_personnel';
    protected $fillable = [
        'store_id',
        'user_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'hire_date',
        'is_active',
    ];

    protected $casts = [
        'hire_date' => 'date',
        'is_active' => 'boolean',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function roles()
    {
        return $this->belongsToMany(StoreRole::class, 'store_personnel_roles');
    }
}
