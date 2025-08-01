<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{   
    
    public function login(Request $request)
    {   
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $user->createToken('user_token')->plainTextToken;

        return response()->json([
            'message' => 'User logged in',
            'status' => 200,
            'token' => $token,
            'user' => [
              'id' => $user->id,
              'email' => $user->email,
            ],
        ]);
    }

    public function logout(Request $request)
{
    $user = auth()->user();

    if ($user) {
        $user->currentAccessToken()->delete();
        return response()->json(['message' => 'User logged out successfully'], 200);
    }

    return response()->json(['message' => 'Unauthenticated'], 401);
}
}
