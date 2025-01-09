<?php

namespace App\Repositories;

use App\Models\Post;
use App\Models\UserComment;
use App\Repositories\Interfaces\PostRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

readonly class PostRepository implements PostRepositoryInterface
{
    public function all(): Collection
    {
        return Post::all();
    }

    public function find(int $id): ?Post
    {
        return Post::findorFail($id);
    }

    public function create(array $data): Post
    {
        return new Post($data);
    }

    public function update(array $data, int $id): Post
    {
        $post = Post::findOrFail($id);

        $post->fill($data);
        $post->save();

        return $post;
    }

    public function delete(int $id): int
    {
        return Post::destroy($id);
    }

    public function getCommentsByID(int $id): \Ramsey\Collection\Collection
    {
        return UserComment::where('post_id', $id)
            ->orderBy('id', 'DESC')
            ->pluck('id');
    }
}
