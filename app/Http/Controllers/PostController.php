<?php

namespace App\Http\Controllers;

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
    Gate::authorize('create', Post::class);

   $datos = $request->validate([
    'email' => ['required', 'email'],
    'password' => ['required'],
    'dispositivo' => ['required'],
]);

$usuario = User::where('email', $datos['email'])->first();

if (! $usuario || ! Hash::check($datos['password'], $usuario->password)) {
    throw ValidationException::withMessages([
        'email' => 'Esas credenciales no coinciden.',
    ]);
}

return [
    'token' => $usuario->createToken($datos['dispositivo'])
                       ->plainTextToken,
];

    $post = Post::create($datos);

    return (new PostResource($post->load(['categoria', 'user'])))
        ->response()
        ->setStatusCode(201);
}

public function destroy(Post $post)
{
    Gate::authorize('delete', $post);
    $post->delete();

    return response()->noContent();   // 204
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


