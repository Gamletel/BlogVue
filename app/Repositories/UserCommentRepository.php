<?php

namespace App\Repositories;

use App\Models\UserComment;
use App\Repositories\Interfaces\UserCommentRepositoryInterface;

class UserCommentRepository implements UserCommentRepositoryInterface
{
    public function show($id): UserComment
    {
        return UserComment::findOrFail($id);
    }

    public function store(array $data): UserComment
    {
        $comment = new UserComment();
        $comment->fill($data);
        $comment->save();
        return $comment;
    }

    public function delete(int $id): int
    {
        return UserComment::destroy($id);
    }
}
