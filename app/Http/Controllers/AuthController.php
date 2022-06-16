<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);
        $token = $user->createToken('key')->plainTextToken;

        return response([
            'status' => true,
            'user' => $user,
            'token' => $token
        ], 201);
    }
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email|bail',
            'password' => 'required',
        ]);

        $user = User::where('email', $data['email'])->first();

        if (!$user) {
            return response([
                'status' => false,
                'message' => 'Email address not recognised',
            ], 401);
        }

        if (!Hash::check($data['password'], $user->password)) {
            return response([
                'status' => false,
                'message' => 'Invalid credentials',
            ], 401);
        }

        $token = $user->createToken('key')->plainTextToken;
        return response([
            'status' => true,
            'user' => $user,
            'token' => $token
        ], 200);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return response([
            'status' => true,
            'message' => 'Logout successfully'
        ], 200);
    }
}
