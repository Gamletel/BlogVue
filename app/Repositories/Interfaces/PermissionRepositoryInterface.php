<?php

namespace App\Repositories\Interfaces;

use App\Models\Permission;
use Illuminate\Support\Collection;

interface PermissionRepositoryInterface
{
    /**
     * @return Collection
     */
    public function all():Collection;

    /**
     * @param int $id
     * @return Permission
     */
    public function show(int $id): Permission;

    /**
     * @param array $data
     * @return Permission
     */
    public function create(array $data): Permission;

    /**
     * @param int $id
     * @param array $data
     * @return Permission
     */
    public function update(int $id, array $data): Permission;

    /**
     * @param int $id
     * @return int
     */
    public function delete(int $id): int;
}
