<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\ModelNotFoundException;

abstract class BaseRepository
{
    protected Model $model;

    /**
     * Create a new class instance.
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all(): Collection
    {
        return Cache::remember(
            get_class($this->model) . '.all',
            3600,
            fn() => $this->model->all()
        );
    }

    public function find(int $id): ?Model
    {
        try {
            return Cache::remember(
                get_class($this->model) . ".{$id}",
                3600,
                fn() => $this->model->findOrFail($id)
            );
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function create(array $data): Model
    {
        $model = $this->model->create($data);
        $this->clearCache();
        return $model;
    }

    public function update(array $data, int $id): Model
    {
        $model = $this->find($id);
        if (!$model) {
            throw new ModelNotFoundException("Model not found with ID: {$id}");
        }
        
        $model->update($data);
        $this->clearCache();
        return $model;
    }

    public function delete(int $id): int
    {
        $result = $this->model->destroy($id);
        $this->clearCache();
        return $result;
    }

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->model->paginate($perPage);
    }

    public function filter(array $filters): Collection
    {
        $query = $this->model->query();

        foreach ($filters as $field => $value) {
            if ($value !== null) {
                $query->where($field, $value);
            }
        }

        return $query->get();
    }

    protected function clearCache(): void
    {
        Cache::forget(get_class($this->model) . '.all');
    }
}
