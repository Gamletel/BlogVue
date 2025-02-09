<?php

namespace App\Repositories\Interfaces;

use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;

interface RoleRepositoryInterface
{
    /**
     * @return Collection
     */
    public function all():Collection;

    /**
     * @return Collection
     */
    public function withPermissions():Collection;

    /**
     * @param $id
     * @return Role
     */
    public function show($id): Role;

    /**
     * @param array $data
     * @return Role
     */
    public function create(array $data):Role;


    /**
     * @param int $id
     * @param array $data
     * @return Role
     */
    public function update(int $id, array $data): Role;

    /**
     * @param int $id
     * @return int
     */
    public function delete(int $id):int;
}
