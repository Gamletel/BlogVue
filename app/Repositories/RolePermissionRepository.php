<?php

namespace App\Repositories;

use App\Models\RolePermission;
use App\Repositories\Interfaces\RolePermissionRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class RolePermissionRepository implements RolePermissionRepositoryInterface
{

    /**
     * @inheritDoc
     */
    public function all(): Collection
    {
        return RolePermission::with(['role', 'permission'])->get()->groupBy('role_id');
    }

    /**
     * @inheritDoc
     */
    public function show($id): RolePermission
    {
        return RolePermission::find($id);
    }

    /**
     * @inheritDoc
     */
    public function create(array $data): RolePermission
    {
        $role = new RolePermission();
        $role->fill($data);
        $role->save();

        return $role;
    }

    /**
     * @param int $id
     * @param array $data
     * @return RolePermission
     */
    public function update(int $id, array $data): RolePermission
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
        return RolePermission::destroy($id);
    }
}
