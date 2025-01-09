<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface
{

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return User::all();
    }

    /**
     * @param int $id
     * @return User
     */
    public function show(int $id): User
    {
        return User::findOrFail($id);
    }

    /**
     * @param array $request
     * @return User
     */
    public function store(Array $request): User
    {
        return User::create($request);
    }

    /**
     * @param array $request
     * @param int $id
     * @return User
     */
    public function update(Array $request, int $id): User
    {
        return User::fill((array)$request);
    }

    /**
     * @param int $id
     * @return int
     */
    public function destroy(int $id): int
    {
        return User::destroy($id);
    }
}
