<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $fillable = ['brand_id', 'name'];

    public function brand()
    {
        return $this->belongsTo(\App\Models\Brand::class);
    }

    public function manuals()
    {
        return $this->hasMany(\App\Models\Manual::class);
    }
}
