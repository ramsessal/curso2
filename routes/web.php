<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $posts = Post::publicados()->with('categoria')->latest()->get();

    return view('portada', ['posts' => $posts]);
});

Route::get('/contacto', fn () => view('contacto'));