<?php

namespace App\Services;

use App\Models\Permission;
use App\Repositories\PermissionRepository;
use Illuminate\Support\Collection;

class PermissionService
{
    /**
     * @param PermissionRepository $permissionRepository
     */
    public function __construct(private readonly PermissionRepository $permissionRepository)
    {
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->permissionRepository->all();
    }

    /**
     * @param int $id
     * @return Permission
     */
    public function show(int $id): Permission
    {
        return $this->permissionRepository->show($id);
    }

    /**
     * @param array $data
     * @return Permission
     */
    public function create(array $data): Permission
    {
        return $this->permissionRepository->create($data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return Permission
     */
    public function update(int $id, array $data): Permission
    {
        return $this->permissionRepository->update($id, $data);
    }

    /**
     * @param int $id
     * @return int
     */
    public function delete(int $id): int
    {
        return $this->permissionRepository->delete($id);
    }
}
