<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\On;
use Livewire\Component;

class ListaAvisos extends Component
{
    #[On('aviso-guardado')]
    public function refrescar(): void
    {
        // El render() vuelve a ejecutarse y la lista se actualiza.
    }

    public function render()
    {
        return view('livewire.lista-avisos', [
            'avisos' => Post::latest()->get(),
        ]);
    }
}
