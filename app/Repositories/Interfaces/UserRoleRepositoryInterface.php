<?php

namespace App\Repositories\Interfaces;

use App\Models\UserRole;
use Illuminate\Support\Collection;

interface UserRoleRepositoryInterface
{
    /**
     * @return Collection
     */
    public function all():Collection;

    /**
     * @param int $id
     * @return UserRole
     */
    public function show(int $id):UserRole;

    /**
     * @param array $data
     * @return UserRole
     */
    public function store(array $data):UserRole;

    /**
     * @param array $data
     * @param int $id
     * @return bool
     */
    public function update(array $data, int $id):bool;

    /**
     * @param int $id
     * @return int
     */
    public function delete(int $id):int;
}
