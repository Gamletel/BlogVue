<?php

namespace App\Services;

use App\Models\UserComment;
use App\Repositories\UserCommentRepository;
use App\Events\CommentCreated;

readonly class UserCommentService
{
    public function __construct(private readonly UserCommentRepository $userCommentRepository)
    {
    }

    public function show($id): UserComment
    {
        return cache()->remember("comments.{$id}", 60 * 60, function () use ($id) {
            return $this->userCommentRepository->show($id);
        });
    }

    public function store(array $data): UserComment
    {
        cache()->forget("posts.comments.{$data['post_id']}");

        $comment = $this->userCommentRepository->store($data);
        event(new CommentCreated($comment));

        return $comment;
    }

    public function delete(int $id): int
    {
        $comment = $this->userCommentRepository->show($id);
        cache()->forget("posts.comments.{$comment['post_id']}");

        return $this->userCommentRepository->delete($id);
    }
}
