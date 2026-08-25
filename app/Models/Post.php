<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['titulo', 'contenido', 'categoria_id', 'publicado'];

        public function categoria()
        {
            return $this->belongsTo(Categoria::class);
        }

        protected $casts = ['publicado' => 'boolean'];

        public function scopePublicados($query)
        {
            return $query->where('publicado', true);
        }

        public function scopeDeCategoria($query, $categoriaId)
        {
            return $query->where('categoria_id', $categoriaId);
        }

        public function etiquetas()
        {
            return $this->belongsToMany(Etiqueta::class);
        }
        protected function resumen(): Attribute
        {
            return Attribute::get(
                fn () => Str::limit($this->contenido, 90)
            );
        }
        protected function esNuevo(): Attribute
        {
            return Attribute::get(fn () =>
                $this->publicado
                && $this->created_at->gt(now()->subDays(7))
            );
        }
}
