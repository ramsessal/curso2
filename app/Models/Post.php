<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// app/Models/Post.php
class Post extends Model
{
    protected $fillable = ['titulo', 'contenido', 'categoria_id', 'publicado']; 
    

   protected $casts = ['publicado' => 'boolean'];

public function scopePublicados($query)
{
    return $query->where('publicado', true);
}

public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

public function scopeDeCategoria($query, $categoriaId)
{
    return $query->where('categoria_id', $categoriaId);
}
}
