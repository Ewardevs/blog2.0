<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\home\CategoryController;
use App\Http\Controllers\home\CommentController;
use App\Http\Controllers\home\PostController;
use App\Http\Controllers\home\UserController;
use Illuminate\Support\Facades\Route;


Route::get("/login", [AuthController::class,"showLogin"])->name("showLogin");
Route::post("/login", [AuthController::class,"Login"])->name("login");


Route::get("/register", [AuthController::class,"showRegister"])->name("showRegister");
Route::post("/register", [AuthController::class,"Register"])->name("register");

Route::get("/", [PostController::class,"index"])->name("pages.home");
Route::get("/post/{id}", [PostController::class,"show"])->name("pages.post");
Route::get("/category/{id}",[CategoryController::class,"view"])->name("category.view");
Route::get("/profile",[UserController::class,"index"])->name("pages.profile");
Route::put("/profile",[UserController::class,"update"])->name("pages.profile.update");

Route::middleware(['auth'])->group(function () {
    Route::post("/post/{id}/comment", [CommentController::class,"store"])->name("pages.home.comment");
    Route::get("/logout", [AuthController::class,"logout"])->name("logout");

});



