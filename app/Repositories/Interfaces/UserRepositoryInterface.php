<?php
namespace App\Repositories\Interfaces;

 use App\Http\Requests\UserStoreRequest;
 use App\Http\Requests\UserUpdateRequest;
 use App\Models\User;
 use Illuminate\Database\Eloquent\Collection;
 use Illuminate\Http\Client\Request;
 use Illuminate\Http\JsonResponse;

 interface UserRepositoryInterface
 {
     public function all(): Collection;
     public function show(int $id): User;
     public function store(Array $request): User;
     public function update(Array $request, int $id): User;
     public function destroy(int $id): int;
 }
