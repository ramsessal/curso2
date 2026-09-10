<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;

class BuscadorAvisos extends Component
{
    public string $busqueda = '';        // ESTADO: viaja en cada petición

    public function limpiar(): void      // ACCIÓN: se llama desde el HTML
    {
        $this->busqueda = '';
    }

    public function render()             // LA VISTA: se vuelve a pintar
    {
        $posts = Post::where('titulo', 'like', "%{$this->busqueda}%")->get();

        return view('livewire.buscador-avisos', [
            'posts' => $posts,
            'avisos' => $posts,
        ]);
    }
}