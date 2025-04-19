<?php

namespace App\Repositories;

use App\Models\Permission;
use Illuminate\Support\Collection;

class PermissionRepository
{

    public function all(): Collection
    {
        return Permission::all();
    }

    public function show(int $id): Permission
    {
        return Permission::findOrFail($id);
    }

    public function create(array $data): Permission
    {
        $permission = new Permission();
        $permission->fill($data);
        $permission->save();

        return $permission;
    }

    public function update(int $id, array $data): Permission
    {
        $permission = $this->show($id);
        $permission->fill($data);
        $permission->save();

        return $permission;
    }

    public function delete(int $id): int
    {
        return Permission::destroy($id);
    }
}
