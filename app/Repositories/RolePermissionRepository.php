<?php

namespace App\Repositories;

use App\Models\RolePermission;
use Illuminate\Database\Eloquent\Collection;

class RolePermissionRepository
{

    public function all(): Collection
    {
        return RolePermission::with(['role', 'permission'])->get()->groupBy('role_id');
    }

    public function show($id): RolePermission
    {
        return RolePermission::find($id);
    }

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

    public function delete(int $id): int
    {
        return RolePermission::destroy($id);
    }
}
