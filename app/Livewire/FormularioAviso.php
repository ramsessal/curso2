<?php

namespace App\Livewire;

use App\Models\Categoria;
use App\Models\Post;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\Validate;
use Livewire\Component;

class FormularioAviso extends Component
{
    #[Validate('required|min:3')]
    public string $titulo = '';

    #[Validate('required')]
    public string $contenido = '';

    #[Validate('required|exists:categorias,id')]
    public ?int $categoria_id = null;

    public function guardar(): void
    {
        Gate::authorize('create', Post::class);

        $datos = $this->validate();
        $post = Post::create($datos + ['user_id' => auth()->id()]);

        $this->dispatch('aviso-guardado', id: $post->id);
        $this->redirectRoute('avisos.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.formulario-aviso', [
            'categorias' => Categoria::orderBy('nombre')->get(),
        ]);
    }
}