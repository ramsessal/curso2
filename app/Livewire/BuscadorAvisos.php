<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;

class BuscadorAvisos extends Component
{
    public string $busqueda = '';

    public function limpiar(): void
    {
        $this->busqueda = '';
    }

    public function render()
    {
        $posts = Post::where('titulo', 'like', "%{$this->busqueda}%")->get();

        return view('livewire.buscador-avisos', [
            'posts' => $posts,
        ]);
    }
}