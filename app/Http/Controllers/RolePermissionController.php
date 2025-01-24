<?php

namespace App\Http\Controllers;

use App\Http\Requests\RolePermission\RolePermissionCreateRequest;
use App\Http\Requests\RolePermission\RolePermissionUpdateRequest;
use App\Services\RolePermissionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RolePermissionController extends Controller
{
    /**
     * @param RolePermissionService $rolePermissionService
     */
    public function __construct(private readonly RolePermissionService $rolePermissionService)
    {
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json($this->rolePermissionService->index());
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        return response()->json($this->rolePermissionService->show($id));
    }

    /**
     * @param RolePermissionCreateRequest $request
     * @return JsonResponse
     */
    public function store(RolePermissionCreateRequest $request): JsonResponse
    {
        return response()->json($this->rolePermissionService->store($request->validated()));
    }

    /**
     * @param int $id
     * @param RolePermissionUpdateRequest $request
     * @return JsonResponse
     */
    public function update(int $id, RolePermissionUpdateRequest $request): JsonResponse
    {
        return response()->json($this->rolePermissionService->update($id, $request->validated()));
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
        return response()->json($this->rolePermissionService->delete($id));
    }
}
