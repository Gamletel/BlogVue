<?php

namespace App\Http\Controllers;

use App\Http\Requests\Role\RoleCreateRequest;
use App\Http\Requests\Role\RoleUpdateRequest;
use App\Services\RoleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct(private readonly RoleService $roleService)
    {
    }

    /**
     * @return JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        return response()->json($this->roleService->index());
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        return response()->json($this->roleService->show($id));
    }

    /**
     * @param RoleCreateRequest $request
     * @return JsonResponse
     */
    public function store(RoleCreateRequest $request): JsonResponse
    {
        return response()->json($this->roleService->store($request->validated()));
    }

    /**
     * @param int $id
     * @param RoleUpdateRequest $request
     * @return JsonResponse
     */
    public function update(int $id, RoleUpdateRequest $request): JsonResponse
    {
        return response()->json($this->roleService->update($id, $request->validated()));
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
        return response()->json($this->roleService->delete($id));
    }
}
