<?php

namespace App\Services;

use App\Models\User;
use App\Notifications\UserRegistered;
use Illuminate\Support\Facades\Hash;

readonly class AuthService
{
    public function register(array $data): array
    {
        $user = new User();
        $user->fill($data);
        $user->save();

        $token = $user->createToken('access_token')->plainTextToken;

        $user->notify(new UserRegistered($user));

        return [
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ];
    }

    public function login(array $data): array|null
    {
        $user = User::where('email', $data['email'])->first();

        if ($user && Hash::check($data['password'], $user->password)) {
            $token = $user->createToken('access_token')->plainTextToken;

            return [
                'user' => $user,
                'access_token' => $token,
                'token_type' => 'Bearer',
            ];
        }

        return null;
    }

    public function logout(): void
    {
        auth()->user()->tokens->each(function ($token) {
            $token->delete();
        });
    }
}
