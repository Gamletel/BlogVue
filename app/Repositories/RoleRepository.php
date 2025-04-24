<?php

namespace App\Repositories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;

class RoleRepository
{

    public function all(): Collection
    {
        return Role::all();
    }

    public function withPermissions(): Collection
    {
        return Role::rightJoin('role_permissions', 'roles.id', '=', 'permissions.role_id')
            ->rightJoib('');
    }

    public function show($id): Collection
    {
        return Role::find($id);
    }

    public function create(array $data): Role
    {
        $role = new Role();
        $role->fill($data);
        $role->save();

        return $role;
    }

    /**
     * @param int $id
     * @param array $data
     * @return Role
     */
    public function update(int $id, array $data): Role
    {
        $role = $this->show($id);
        $role->fill($data);
        $role->save();
        return $role;
    }

    public function delete(int $id): int
    {
        return Role::destroy($id);
    }
}
