<?php

namespace App\Http\Controllers\Api\Admin;

use App\Eloquent\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect']
            ]);
        }

        // return $user->createToken('authToken')->accessToken;
        // return [
        //     'data' => [
        //         'email' => $request->email,
        //         'password' => $request->password
        //     ],
        //     'token' => $user->createToken('authToken')->accessToken,
        // ];

        return response()->json([
            'access_token' => $user->createToken('authToken')->accessToken,
            'token_type'   => 'Bearer',
        ]);

    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
}
