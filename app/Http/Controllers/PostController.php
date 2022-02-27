<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        $post = Post::all();
        return view('posts.index', compact('post'));
    }

    public function publish(Post $post){
        $post->update([
            'is_published' => true
        ]);
        return back();
    }
}
