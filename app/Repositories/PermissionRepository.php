<?php

namespace App\Repositories;

use App\Models\Permission;
use App\Repositories\Interfaces\PermissionRepositoryInterface;
use Illuminate\Support\Collection;

class PermissionRepository implements Interfaces\PermissionRepositoryInterface
{

    /**
     * @inheritDoc
     */
    public function all(): Collection
    {
        return Permission::all();
    }

    /**
     * @inheritDoc
     */
    public function show(int $id): Permission
    {
        return Permission::findOrFail($id);
    }

    /**
     * @inheritDoc
     */
    public function create(array $data): Permission
    {
        $permission = new Permission();
        $permission->fill($data);
        $permission->save();

        return $permission;
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, array $data): Permission
    {
        $permission = $this->show($id);
        $permission->fill($data);
        $permission->save();

        return $permission;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id): int
    {
        return Permission::destroy($id);
    }
}
