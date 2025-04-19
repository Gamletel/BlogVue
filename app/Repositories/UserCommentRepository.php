<?php

namespace App\Repositories;

use App\Models\UserComment;

class UserCommentRepository
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
