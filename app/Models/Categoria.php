<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

// app/Models/Categoria.php
class Categoria extends Model
{
    use HasFactory;

    protected $fillable = ['nombre'];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}

