<?php

namespace App\Repositories;

use App\Models\UserComment;
use App\Repositories\Interfaces\UserCommentRepositoryInterface;

class UserCommentRepository implements UserCommentRepositoryInterface
{
    public function show(int $id): UserComment
    {
        return UserComment::findOrFail($id);
    }

    public function store(array $data): UserComment
    {
        return new UserComment($data);
    }

    public function delete(int $id): int
    {
        return UserComment::destroy($id);
    }
}
