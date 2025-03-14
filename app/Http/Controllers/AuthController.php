<?php

namespace App\Http\Controllers;

use App\Services\ApiResponse;
use Illuminate\Http\Request;

class AuthController extends Controller{
    
    public function login(Request $request){
        // Validate the request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        //login attempt
        $email = $request->input('email');
        $password = $request->input('password');
        $attempt = auth()->attempt([
            'email' => $email,
            'password' => $password
        ]);

        if(!$attempt){
           return ApiResponse::unauthorized();
        }

        //authenticate user
        $user = auth()->user();
        $token = $user->createToken($user->name)->plainTextToken;

        //return token
        return ApiResponse::success([
            'user' => $user->name,
            'email' => $user->email,
            'token' => $token
        ]);
    }
}
