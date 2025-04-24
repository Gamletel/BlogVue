<?php

namespace App\Repositories;

use App\Models\Post;
use App\Models\UserComment;
use Illuminate\Database\Eloquent\Collection;

class PostRepository extends BaseRepository
{
    public function __construct(Post $model)
    {
        parent::__construct($model);
    }

    public function getCommentsByID(int $id): Collection
    {
        return $this->model->findOrFail($id)
            ->comments()
            ->orderBy('id', 'DESC')
            ->get();
    }
}
