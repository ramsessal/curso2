<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['titulo', 'contenido', 'categoria_id'];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function scopePublicados(Builder $query): Builder
    {
        return $query->where('publicado', true);
    }
}