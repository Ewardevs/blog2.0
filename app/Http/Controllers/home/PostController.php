<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comments;
use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    public function index(){
        $posts = Posts::orderBy("created_at","desc")->paginate(12);
        $post = Posts::orderBy("created_at", "desc")->first();

        $categories = Category::all();
        return view("home", [
            "posts"=> $posts,
            "categories"=> $categories,
            "feature_post"=>$post
        ]);
    }
    public function show($id){
        $posts = Posts::find($id);
        $comments = Cache::remember("post_comments_{$id}", 60, function () use ($id) {
            return Comments::with('user') // Cargar relación de usuario
                ->where("posts_id", $id)
                ->orderBy("created_at", "desc")
                ->get();
        });
        return view("post",[
            "posts"=> $posts,
            "comments"=>$comments
        ]);
    }
}
