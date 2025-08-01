<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
class AdminController extends Controller
{     
    use HasApiTokens;
     public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if (! $admin || ! Hash::check($request->password, $admin->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $admin->createToken('admin_token')->plainTextToken;

        return response()->json([
            'message' => 'Admin logged in',
             'status' => 200,
            'token' => $token
        ]);
    }

    public function logout(Request $request)
{
    $admin = auth()->user();

    if ($admin) {
        $admin->currentAccessToken()->delete();
        return response()->json(['message' => 'Admin logged out successfully'], 200);
    }

    return response()->json(['message' => 'Unauthenticated'], 401);
}
}
