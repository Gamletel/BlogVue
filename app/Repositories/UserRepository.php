<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository extends BaseRepository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return User::all();
    }

    public function show(int $id)   
    {
        return $this->find($id);
    }

    public function store(array $data)
    {
        return $this->create($data);
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
        return $this->delete($id);
    }
}
