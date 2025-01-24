<?php

namespace App\Repositories;

use App\Models\Role;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class UserRoleRepository implements Interfaces\RoleRepositoryInterface
{

    /**
     * @inheritDoc
     */
    public function all(): Collection
    {
        return Role::all();
    }

    /**
     * @inheritDoc
     */
    public function show($id): Role
    {
        return Role::findOrFail($id);
    }

    /**
     * @inheritDoc
     */
    public function create(array $data): Role
    {
        $role = new Role();
        $role->fill($data);
        $role->save();

        return $role;
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, array $data): Role
    {
        $role = Role::findOrFail($id);
        $role->fill($data);
        $role->save();

        return $role;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id): int
    {
        return Role::destroy($id);
    }
}
