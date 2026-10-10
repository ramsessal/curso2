<?php

namespace App\Http\Controllers;

use App\Jobs\EnviarAvisoPorCorreo;
use App\Models\Categoria;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::publicados()
            ->with('categoria')
            ->when($request->categoria, fn ($query, $id) => $query->deCategoria($id))
            ->latest()
            ->paginate(10);

        return view('portada', [
            'posts' => $posts,
        ]);
    }

    public function create()
    {
        return view('avisos.crear', [
            'categorias' => Categoria::orderBy('nombre')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'titulo' => ['required', 'max:120'],
            'contenido' => ['required'],
            'categoria_id' => ['required', 'exists:categorias,id'],
        ]);

        $post = Post::create($datos);
        EnviarAvisoPorCorreo::dispatch($post);

        return redirect()
            ->route('avisos.index')
            ->with('ok', "Aviso #{$post->id} creado correctamente.");
    }

    public function destroy(Post $post)
    {
        $id = $post->id;
        $post->delete();

        return redirect()
            ->route('avisos.index')
            ->with('ok', "Aviso #{$id} eliminado correctamente.");
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

}


