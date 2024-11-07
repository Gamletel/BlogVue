<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\File;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(User::all());
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $user = User::find($id);

        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'avatar' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'name' => 'nullable|string|min:5',
            'email' => 'nullable|email',
        ]);

        $user = User::findOrFail($id);

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars');

            $data['avatar'] = $path;
        }

        $user->update($data);

        return response()->json([
            'message' => 'User is updated',
            'user' => $user,
            'avatar_path' => $user->avatar,
        ]);
    }
}