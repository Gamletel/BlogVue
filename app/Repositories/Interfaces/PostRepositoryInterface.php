<?php
namespace App\Repositories\Interfaces;

use App\Models\Post;
use Ramsey\Collection\Collection;

interface PostRepositoryInterface{
    public function all(): \Illuminate\Database\Eloquent\Collection;
    public function find(int $id): ?Post;
    public function create(array $data): Post;
    public function update(array $data, int $id): Post;
    public function delete(int $id): int;

    public function getCommentsByID(int $id): Collection;
}
