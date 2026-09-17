<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\App\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;                    
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
   public function index(Request $request)
{
    $avisos = Post::publicados()
        ->with(['categoria', 'user'])
        ->when($request->categoria, fn ($q, $id) => $q->deCategoria($id))
        ->latest()
        ->paginate(10);

    return PostResource::collection($avisos);
}

    public function create()
    {
        return view('avisos.crear', ['categorias' => Categoria::orderBy('nombre')->get()
        ]);
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'titulo' => ['required', 'max:120'],
            'contenido' => ['required'],
            'categoria_id' => ['required', 'exists:categorias,id'],
        ]);

        Post::create($datos);

        return redirect()->route('avisos.index');
    }

    public function edit(Post $post)
    {
        return view('avisos.editar', [
            'post' => $post,
            'categorias' => Categoria::orderBy('nombre')->get(),
        ]);
    }

    public function update(Request $request, Post $post)
    {
        $datos = $request->validate([
            'titulo' => ['required', 'max:120'],
            'contenido' => ['required'],
            'categoria_id' => ['required', 'exists:categorias,id'],
        ]);

        $post->update($datos);

        return redirect()->route('avisos.index');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('avisos.index');
    }
}


