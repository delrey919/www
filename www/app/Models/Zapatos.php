<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zapatos extends Model
{
    protected $fillable = [
        'name',
        'description',
        'mail',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class);
    }
}
