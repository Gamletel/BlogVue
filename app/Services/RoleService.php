<?php

namespace App\Services;

use App\Models\Role;
use App\Repositories\RoleRepository;

class RoleService
{
    public function __construct(private RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function index()
    {
        return $this->roleRepository->all();
    }

    /**
     * @param int $id
     * @return Role
     */
    public function show(int $id): Role
    {
        return $this->roleRepository->show($id);
    }

    /**
     * @param array $data
     * @return Role
     */
    public function store(array $data): Role
    {
        return $this->roleRepository->create($data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return Role
     */
    public function update(int $id, array $data): Role
    {
        return $this->roleRepository->update($id, $data);
    }

    /**
     * @param int $id
     * @return int
     */
    public function delete(int $id): int
    {
        return $this->roleRepository->delete($id);
    }
}
