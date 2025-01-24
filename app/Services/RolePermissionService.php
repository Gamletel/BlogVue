<?php

namespace App\Services;

use App\Models\Role;
use App\Models\RolePermission;
use App\Repositories\RolePermissionRepository;
use Illuminate\Database\Eloquent\Collection;

class RolePermissionService
{
    public function __construct(private readonly RolePermissionRepository $rolePermissionRepository)
    {
    }

    public function index(): Collection
    {
        return $this->rolePermissionRepository->all();
    }

    /**
     * @param int $id
     * @return RolePermission
     */
    public function show(int $id): RolePermission
    {
        return $this->rolePermissionRepository->show($id);
    }

    /**
     * @param array $data
     * @return RolePermission
     */
    public function store(array $data): RolePermission
    {
        return $this->rolePermissionRepository->create($data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return RolePermission
     */
    public function update(int $id, array $data): RolePermission
    {
        return $this->rolePermissionRepository->update($id, $data);
    }

    /**
     * @param int $id
     * @return int
     */
    public function delete(int $id): int
    {
        return $this->rolePermissionRepository->delete($id);
    }
}
