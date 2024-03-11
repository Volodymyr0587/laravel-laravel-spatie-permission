<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreUpdatePostRequest;

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

    public function store(StoreUpdatePostRequest $request)
    {
        $post = auth()->user()->posts()->create($request->validated());

        $this->attachTagsToModel($request, $post);

        $this->saveImage($post, $request);

        return redirect()->route('admin-writer.postsList')
            ->with('message', 'Post created successfully.');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'))->with('user');
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(StoreUpdatePostRequest $request, Post $post)
    {
        $post->is_active = $request->boolean('is_active');

        $post->update($request->validated());

        // Handle image upload
        $this->saveImage($post, $request);

        return redirect()->route('admin-writer.postsList')
            ->with('message', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin-writer.postsList')
            ->with('message', 'Post deleted successfully.');
    }

    /**
     * Save image logic
     */
    protected function saveImage(Post $post, Request $request)
    {
        if ($request->hasFile('image')) {
            $imagePath = time() . '.' . $request->image->extension();
            $post->image = $imagePath;
            $request->image->storeAs('public/images/posts', $imagePath);
            $post->save();
        }
    }

    protected function attachTagsToModel($request, $post)
    {
        // Trim white spaces from beginning and end
        // Replace multiple white spaces with single white space
        $tags = preg_replace('/\s+/', ' ', trim($request->tags));
        // Convert string to lower case
        $tags = strtolower($tags);
        // Convert string of tags to array of tags
        $tags = explode(' ', $tags);

        //adding multiple tags
        $post->attachTags($tags);
    }
}
