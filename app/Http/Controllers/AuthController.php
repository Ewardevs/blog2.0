<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view("Auth.login");
    }
    public function showRegister()
    {
        return view("Auth.register");
    }
    public function login(LoginRequest $request)
    {
        $user = Auth::attempt([
            "email" => $request->email,
            "password" => $request->password
        ]);

        if (!$user) {
            return response()->json([
                "status" => "error",
                "message" => "invalid"
            ], 0);
        }
        return redirect()->back();
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create($request->all());

        return redirect()->route("showLogin")->with("success","");
    }

    public function logout(){
        Auth::logout();
        return redirect()->route("pages.home")->with("success","succesfully logout");
    }
}
