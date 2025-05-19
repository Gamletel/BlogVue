<?php

namespace App\Services;

use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Collection;

readonly class UserService
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return cache()->remember('users.all', 3600, function () {
            return $this->userRepository->all();
        });
    }

    public function show(int $id)
    {
        return cache()->remember("users.{$id}", 3600, function () use ($id) {
            return $this->userRepository->show($id);
        });
    }

    public function store(array $data): User
    {
        cache()->forget('users.all');

        return $this->userRepository->store($data);
    }

    public function update(UserUpdateRequest $request, int $id): User
    {
        $user = User::findOrFail($id);

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars');
            $request['avatar'] = $path;
        }

        $user->update($request->except('password', 'old_password'));

        if ($request->filled('password')) {
            $password = $request->validate(['password' => 'required|min:5']);
            $password_old = $request->validate(['old_password' => 'required|current_password:sanctum']);
            $user->update($password);
        }

        cache()->forget("users.{$id}");

        return $this->userRepository->update($request->validated(), $id);
    }

    public function destroy(int $id): int
    {
        cache()->forget("users.{$id}");
        cache()->forget('users.all');

        return $this->userRepository->destroy($id);
    }

}
