<?php

namespace App\Services;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Client\Request;

readonly class UserService
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function all(): Collection
    {
        return $this->userRepository->all();
    }

    public function show(int $id): User
    {
        return $this->userRepository->show($id);
    }

    public function store(UserStoreRequest $request): User
    {
        return $this->userRepository->store((array)$request);
    }

    public function update(UserUpdateRequest $request, int $id): User
    {
        $user = User::findOrFail($id);

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars');

            $request['avatar'] = $path;
        }

        $user->update($request);

        if($request->input('password')){
            $password = $request->validate(['password'=>'required|min:5']);
            $password_old = $request->validate(['old_password'=>'required|current_password:sanctum']);

            $user->update($password);
        }

        return $this->userRepository->update((array)$request, $id);
    }

    public function destroy(int $id): int
    {
        return $this->userRepository->destroy($id);
    }

}
