<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string'
        ]);

        $data['password'] = bcrypt($request->password);

        $user = User::create($data);

        $token = $user->createToken('API Token')->accessToken;

        return response([ 
            'user' => $user
            // 'token' => $token
        ]);
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($data)) {
            return response([
                'error_message' => 'Incorrect Details. Please try again'
            ], 401);
        }

        $token = auth()->user()->createToken('API Token')->accessToken;

        return response([
            'user' => auth()->user(), 
            'token' => $token
        ]);

    }
}
