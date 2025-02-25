<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\Posts;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function view($id)
    {
        $posts = Posts::where("category_id", $id)->with("category")->get();

        if ($posts->isEmpty()) {
            return abort(404); // Retorna un error 404 si no hay posts en la categoría
        }

        $category = $posts->first()->category->name; // Obtiene la categoría del primer post

        return view("category", [
            "posts" => $posts,
            "category" => $category
        ]);
    }
}
