<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\EnviarAvisoPorCorreo;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return Post::publicados()->with('categoria')->latest()->paginate(10);
    }

    public function show(Post $post)
    {
        return $post;
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
        return response()->json($post->load('categoria'), 201);
    }

    public function update(Request $request, Post $post)
    {
        $datos = $request->validate([
            'titulo' => ['required', 'max:120'],
            'contenido' => ['required'],
            'categoria_id' => ['required', 'exists:categorias,id'],
        ]);

        $post->update($datos);

        return $post->load('categoria');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return response()->noContent();
    }
}