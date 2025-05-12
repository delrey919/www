<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anunci extends Model
{
    protected $fillable = [
        'name',
        'description',
        'date',
        'hora',
        'mail',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class);
    }
}