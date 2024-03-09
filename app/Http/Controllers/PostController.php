<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy("created_at","desc")->paginate(3);
        return view("home", compact("posts"));
    }

    public function postsList()
    {
        $posts = Post::orderBy("created_at","desc")->paginate(6);

        return view("posts.list", compact("posts"));
    }

    public function create()
    {
        return view("posts.create");
    }
}
