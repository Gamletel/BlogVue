<?php

namespace App\Services;

use App\Models\UserComment;
use App\Repositories\UserCommentRepository;

readonly class UserCommentService{
    public function __construct(private readonly UserCommentRepository $userCommentRepository)
    {
    }

    public function show(int $id): UserComment
    {
        return $this->userCommentRepository->show($id);
    }

    public function store(array $data): UserComment
    {
        return $this->userCommentRepository->store($data);
    }

    public function delete(int $id): int
    {
        return $this->userCommentRepository->delete($id);
    }
}
