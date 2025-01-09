<?php

namespace App\Services;

use App\Models\Post;
use App\Repositories\PostRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

readonly class PostService
{
    public function __construct(private PostRepository $postRepository, private UserService $userService)
    {
    }

    public function all(): Collection
    {
        return cache()->remember('posts.all', 60 * 60, function () {
            return $this->postRepository->all();
        });
    }

    public function show(int $id): array
    {
        return cache()->remember("posts.{$id}", 60 * 24, function () use ($id) {
            $post = $this->postRepository->find($id);
            $user = $this->userService->show($post->user_id);

            return [
                'post' => $post,
                'user' => $user
            ];
        });
    }

    public function store(array $data): Post
    {
        cache()->forget('posts.all');

        return $this->postRepository->create($data);
    }

    public function update(array $data, int $id): Post
    {
        cache()->forget('posts.all');

        return $this->postRepository->update($data, $id);
    }

    public function delete(int $id): int
    {
        cache()->forget('posts.all');

        return $this->postRepository->delete($id);
    }

    public function getCommentsByID(int $id)
    {
        return cache()->remember("posts.comments.{$id}", 60 * 60, function () use ($id) {
            return $this->postRepository->getCommentsByID($id);
        });
    }
}
