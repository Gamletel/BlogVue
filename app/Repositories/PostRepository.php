<?php

namespace App\Repositories;

use App\Models\Post;
use App\Models\UserComment;
use Illuminate\Database\Eloquent\Collection;

readonly class PostRepository
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
        $post = new Post();
        $post->fill($data);
        $post->save();
        return $post;
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

    public function getCommentsByID(int $id)
    {
        return UserComment::where('post_id', $id)
            ->orderBy('id', 'DESC')
            ->pluck('id');
    }
}
