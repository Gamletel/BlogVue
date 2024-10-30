<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => 'required|string|min:5|max:32|unique:users',
            'email' => 'nullable|email|unique:users',
            'password' => 'required|confirmed|min:5',
//            'avatar'=>'nullable|file|size:512'
            'remember' => 'nullable|boolean',
        ]);

        $user = new User();
        $user['name'] = $data['name'];
        $user['email'] = $data['email'];
        $user['password'] = $data['password'];

        $user->save();

        if (auth()->attempt([
            'email' => $user['name'],
            'password' => $user['password'],
        ], $data['remember'])) {
            session()->regenerate();

            $user = auth()->user();

            return response()->json([
                'message' => 'register is success',
                'user' => $user,
            ]);
        }

        return response()->json(['message' => 'error']);
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'logout success']);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $data = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
            'remember' => 'nullable|boolean',
        ]);

        if (auth()->attempt([
            'email' => $data['email'],
            'password' => $data['password'],
        ], $data['remember'])) {
            session()->regenerate();

            $tokenResult = $request->user()->createToken('access_token');
            $token = $tokenResult->plainTextToken;

            return response()->json([
                'message' => 'auth success',
                'user' => auth()->user(),
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]);
        } else {
            return response()->json([
                'message' => 'auth error'
            ]);
        }
    }
}
