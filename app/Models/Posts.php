<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Posts extends Model
{
    use HasFactory;

    protected $fillable = ["title","body","category_id","slug","user_id","image","extract"];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments(){
        return $this->hasMany(Comments::class);
    }

    protected static function booted()
    {
        static::created(function () {
            self::clearCache();
        });

        static::updated(function () {
            self::clearCache();
        });

        static::deleted(function () {
            self::clearCache();
        });
        static::updated(function ($post) {
            Cache::forget("post_{$post->id}");
            Cache::forget("post_comments_{$post->id}");
        });

        static::deleted(function ($post) {
            Cache::forget("post_{$post->id}");
            Cache::forget("post_comments_{$post->id}");
        });
    }

    public static function clearCache()
    {
        Cache::forget('feature_post');
        Cache::forget('categories_all');

        // Borrar todas las páginas de caché
        foreach (range(1, 10) as $page) { // Cambia el 10 según la cantidad máxima de páginas
            Cache::forget("posts_paginated_page_{$page}");
        }
    }

}
