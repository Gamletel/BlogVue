<?php

namespace App\Repositories\Interfaces;

use App\Models\RolePermission;
use Illuminate\Database\Eloquent\Collection;

interface RolePermissionRepositoryInterface
{
    /**
     * @return Collection
     */
    public function all():Collection;

    /**
     * @param $id
     * @return RolePermission
     */
    public function show($id): RolePermission;

    /**
     * @param array $data
     * @return RolePermission
     */
    public function create(array $data):RolePermission;


    /**
     * @param int $id
     * @param array $data
     * @return RolePermission
     */
    public function update(int $id, array $data): RolePermission;

    /**
     * @param int $id
     * @return int
     */
    public function delete(int $id):int;
}
