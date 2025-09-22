<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    public function getNameUrlEncodedAttribute()
    {
        $name_url_encoded = str_replace('/', '', $this->name);
        return $name_url_encoded;
    }

    // Relaties
    public function manuals()
    {
        return $this->hasMany(\App\Models\Manual::class);
    }

    public function types()
    {
        return $this->hasMany(\App\Models\Type::class);
    }
}
