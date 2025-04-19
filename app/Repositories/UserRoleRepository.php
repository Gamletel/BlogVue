<?php

namespace App\Repositories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;

class UserRoleRepository
{

    public function all(): Collection
    {
        return Role::all();
    }

    public function show($id): Role
    {
        return Role::findOrFail($id);
    }

    public function create(array $data): Role
    {
        $role = new Role();
        $role->fill($data);
        $role->save();

        return $role;
    }

    public function update(int $id, array $data): Role
    {
        $role = Role::findOrFail($id);
        $role->fill($data);
        $role->save();

        return $role;
    }

    public function delete(int $id): int
    {
        return Role::destroy($id);
    }
}
