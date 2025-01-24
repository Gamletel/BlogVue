<?php
namespace App\Repositories\Interfaces;

 use App\Models\User;
 use Illuminate\Database\Eloquent\Collection;

 interface UserRepositoryInterface
 {
     /**
      * @return Collection
      */
     public function all(): Collection;

     /**
      * @param int $id
      * @return User
      */
     public function show(int $id): User;

     /**
      * @param array $data
      * @return User
      */
     public function store(array $data): User;

     /**
      * @param array $data
      * @param int $id
      * @return User
      */
     public function update(array $data, int $id): User;

     /**
      * @param int $id
      * @return int
      */
     public function destroy(int $id): int;
 }
