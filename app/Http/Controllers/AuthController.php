<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|string|in:seller,buyer,owner',
            'password' => 'required|string|min:6|confirmed'
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password'])
        ]);

        $token = $user->createToken('auth-token')->plainTextToken;
        return response()->json([
            'message' => "Registrasi berhasil",
            'user' => $user,
            'token' => $token
        ]);
    }

    public function login(Request $request) {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        $user  = User::where('email', $validated['email'])->first();
        // $passwordValid = ;

        if(!$user || !Hash::check($validated['password'], $user->password)) {
            return response()->json([
                'message' => "email atau password salah"
            ], 401);
        }


        //generate lgoin
        $token = $user->createToken('auth-token')->plainTextToken;
        return response()->json([
            'message' => "Login Berhasil",
            'user' => $user,
            'token' => $token
        ]);


    }


    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message' => "Logut Berhasil"
        ]);
    }
}
