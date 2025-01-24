<?php

namespace App\Repositories\Interfaces;

use App\Models\UserComment;

interface UserCommentRepositoryInterface
{
    /**
     * @param $id
     * @return UserComment
     */
    public function show($id): UserComment;

    /**
     * @param array $data
     * @return UserComment
     */
    public function store(array $data): UserComment;

    /**
     * @param int $id
     * @return int
     */
    public function delete(int $id): int;
}
