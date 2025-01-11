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
     * @param array $data
     * @return User
     */
    public function store(array $data): User
    {
        return User::create($data);
    }

    /**
     * @param array $data
     * @param int $id
     * @return User
     */
    public function update(array $data, int $id): User
    {
        $user = User::findOrFail($id);
        $user->fill($data);
        $user->save();
        return $user;
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
