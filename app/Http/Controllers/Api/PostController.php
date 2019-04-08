<?php

namespace App\Http\Controllers\Api;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\UserNotDefinedException;

use Tymon\JWTAuth\Facades\JWTAuth;

class PostController extends Controller
{

    /*public function __construct()
    {
        $this->middleware('auth:api');
    }*/

    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }

    protected $user;

    public function all()
    {
        return Post::all();
    }

    public function index(Request $request)
    {
        $posts=DB::table('posts')
            ->where('user_id',$request->user_id)
            ->get();

        return $posts;
//        return $this->user->posts();
    }

    public function create(Request $request)
    {

        $post = new Post();
        $post->user_id = $request->user_id;
        $post->title = $request->post_title;
        $post->content = $request->post_content;
        $post->save();

        return $post;

    }


    public function self(Request $request)
    {
//        $posts = auth()->user()->posts;

        try {
            $user = auth()->userOrFail();
        } catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e) {
            return response()->json([
                'error' => $e . getMessage()
            ]);
        }

        return $user->Post();
    }

    public function show($id){
        $post = DB::table('posts')
            ->where('id',$id)
            ->first();

        return response()->json(['post'=>$post]);
    }


}
