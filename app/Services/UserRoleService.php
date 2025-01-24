<?php

namespace App\Services;

use App\Models\Role;
use App\Repositories\UserRoleRepository;
use Illuminate\Database\Eloquent\Collection;

class UserRoleService
{
    /**
     * @param UserRoleRepository $userRoleRepository
     */
    public function __construct(private readonly UserRoleRepository $userRoleRepository)
    {
    }

    /**
     * @return Collection
     */
    public function index(): Collection
    {
        return $this->userRoleRepository->all();
    }

    /**
     * @param int $id
     * @return Role
     */
    public function show(int $id): Role
    {
        return $this->userRoleRepository->show($id);
    }

    /**
     * @param array $data
     * @return Role
     */
    public function store(array $data): Role
    {
        return $this->userRoleRepository->create($data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return Role
     */
    public function update(int $id, array $data): Role
    {
        return $this->userRoleRepository->update($id, $data);
    }

    /**
     * @param int $id
     * @return int
     */
    public function destroy(int $id): int
    {
        return $this->userRoleRepository->delete($id);
    }
}
