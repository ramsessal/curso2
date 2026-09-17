<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;

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
}