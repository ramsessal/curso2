<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Gate;

class PostResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'titulo' => $this->titulo,
            'resumen' => $this->resumen,
            'contenido' => $this->contenido,
            'publicado' => $this->publicado,
            'categoria' => $this->whenLoaded('categoria', fn() => [
                'id' => $this->categoria->id,
                'nombre' => $this->categoria->nombre,
            ]),
            'autor' => $this->whenLoaded('user', fn() => $this->user?->name),
            'puede_borrar' => $request->user() !== null
                && Gate::allows('delete', $this->resource),
            'creado' => $this->created_at->toIso8601String(),
            'destinatarios' => $this->destinatarios ?? 0,
            'notificados' => $this->notificados ?? 0,

        ];
    }
}
