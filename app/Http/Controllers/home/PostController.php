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
        $page = request()->get('page', 1); // Obtiene el número de página actual
        $cacheKey = "posts_paginated_page_{$page}"; // Clave de caché única por página

        $posts = Cache::remember($cacheKey, now()->addMinutes(10), function () {
            return Posts::orderBy("created_at", "desc")->paginate(12);
        });

        $featurePost = Cache::remember('feature_post', now()->addMinutes(10), function () {
            return Posts::orderBy("created_at", "desc")->first();
        });

        $categories = Cache::remember('categories_all', now()->addMinutes(10), function () {
            return Category::all();
        });

        return view("home", [
            "posts" => $posts,
            "categories" => $categories,
            "feature_post" => $featurePost
        ]);

    }
    public function show($id){
        $posts = Cache::remember("post_{$id}", 60, function () use ($id) {
            return Posts::find($id);
        });

        if (!$posts) {
            abort(404); // Si el post no existe, muestra error 404
        }

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
