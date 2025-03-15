<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('replies')->latest()->get();
        return view('posts.index', compact('posts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        Post::create($request->only('title', 'content'));

        return redirect()->route('posts.index');
    }
}
