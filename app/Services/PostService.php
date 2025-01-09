<?php

namespace App\Services;

use App\Models\Post;
use App\Repositories\PostRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class PostService
{
    public function __construct(private readonly PostRepository $postRepository, private readonly UserService $userService)
    {
    }

    public function all(): Collection
    {
        return $this->postRepository->all();
    }

    public function show(int $id): array
    {
        $post = $this->postRepository->find($id);
        $user = $this->userService->show($post->user_id);
        return [
            'post' => $post,
            'user' => $user
        ];
    }

    public function store(array $data): Post
    {
        return $this->postRepository->create($data);
    }

    public function update(array $data, int $id): Post
    {
        return $this->postRepository->update($data, $id);
    }

    public function delete(int $id): int
    {
        return $this->postRepository->delete($id);
    }

    public function getCommentsByID(int $id): \Ramsey\Collection\Collection
    {
        return $this->postRepository->getCommentsByID($id);
    }
}
