<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreDocument extends Model
{
    protected $table = 'store_documents';
    protected $fillable = [
        'store_id',
        'title',
        'category',
        'file_path',
        'description',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
