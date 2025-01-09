<?php

namespace App\Services;

use App\Http\Requests\RegisterRequest;
use App\Models\User;

readonly class AuthService
{
    public function register(array $data): User
    {
        $user = new User();
        $user->fill($data);
        $user->save();

        auth()->login($user, $data['remember'] ?? false);
        session()->regenerate();

        return $user;
    }

    public function login(array $data): array|null
    {
        if (auth()->attempt([
            'email' => $data['email'],
            'password' => $data['password'],
        ], $data['remember'] ?? false)) {
            session()->regenerate();

            $user = auth()->user();
            $token = $user->createToken('access_token')->plainTextToken;

            return [
                'user' => $user,
                'access_token' => $token,
                'token_type' => 'Bearer',
            ];
        } else {
            return null;
        }
    }

    public function logout(array $data)
    {
        auth()->logout();
        auth()->user()->tokens()->delete();
    }
}
