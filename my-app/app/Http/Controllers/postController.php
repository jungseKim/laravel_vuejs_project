<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class postController extends Controller
{



    public function posts()
    {
        return Post::all();
    }
    public function store(Request $request)
    {
        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->user_id = $request->user_id;
        $post->save();
        return $post;
    }
}
