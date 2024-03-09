<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy("created_at", "desc")
            ->where('is_active', true)
            ->with('user')->paginate(3);
        return view("home", compact("posts"));
    }

    public function postsList()
    {
        $posts = Post::orderBy("created_at", "desc")->with('user')->paginate(6);

        return view("posts.list", compact("posts"));
    }

    public function create()
    {
        return view("posts.create");
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        auth()->user()->posts()->create($validated);

        return redirect()->route('admin-writer.postsList')
            ->with('message', 'Post created successfully.');
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        $post->is_active = $request->boolean('is_active');
        $post->update($validated);



        return redirect()->route('admin-writer.postsList')
            ->with('message', 'Post updated successfully.');
    }
}
