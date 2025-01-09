<?php

namespace App\Repositories\Interfaces;

use App\Models\UserComment;

interface UserCommentRepositoryInterface
{
    public function show(int $id): UserComment;
    public function store(array $data): UserComment;
    public function delete(int $id): int;
}
