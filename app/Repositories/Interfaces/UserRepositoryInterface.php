<?php
namespace App\Repositories\Interfaces;

 use App\Models\User;
 use Illuminate\Database\Eloquent\Collection;

 interface UserRepositoryInterface
 {
     public function all(): Collection;
     public function show(int $id): User;
     public function store(array $data): User;
     public function update(array $data, int $id): User;
     public function destroy(int $id): int;
 }
