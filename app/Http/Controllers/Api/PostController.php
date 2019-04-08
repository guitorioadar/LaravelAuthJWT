<?php

namespace App\Http\Controllers\Api;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function all(){
        return Post::all();
    }

    public function create(Request $request){

        $post = new Post();
        $post->user_id = $request->user_id;
        $post->title = $request->title;
        $post->content = $request->post_content;
        $post->save();

    }
}
