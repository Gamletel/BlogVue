<?php

namespace App\Repositories;

use App\Models\Role;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class RoleRepository implements Interfaces\RoleRepositoryInterface
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
    public function withPermissions(): Collection
    {
        return Role::rightJoin('role_permissions', 'roles.id', '=', 'permissions.role_id')
            ->rightJoib('');
    }

    /**
     * @inheritDoc
     */
    public function show($id): Role
    {
        return Role::find($id);
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

    /**
     * @inheritDoc
     */
    public function delete(int $id): int
    {
        return Role::destroy($id);
    }
}
