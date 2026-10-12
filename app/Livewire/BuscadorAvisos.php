<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;

class BuscadorAvisos extends Component
{
    public string $busqueda = '';

    public function render()
    {
        return view('livewire.buscador-avisos', [
            'avisos' => Post::publicados()
                ->where('titulo', 'like', "%{$this->busqueda}%")
                ->latest()
                ->get(),
        ]);
    }
}
