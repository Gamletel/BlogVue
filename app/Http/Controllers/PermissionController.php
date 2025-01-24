<?php

namespace App\Http\Controllers;

use App\Http\Requests\Permission\PermissionCreateRequest;
use App\Http\Requests\Permission\PermissionUpdateRequest;
use App\Services\PermissionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * @param PermissionService $permissionService
     */
    public function __construct(private readonly PermissionService $permissionService)
    {
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json($this->permissionService->all());
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        return response()->json($this->permissionService->show($id));
    }

    /**
     * @param PermissionCreateRequest $request
     * @return JsonResponse
     */
    public function store(PermissionCreateRequest $request): JsonResponse
    {
        return response()->json($this->permissionService->create($request->validated()));
    }

    /**
     * @param int $id
     * @param PermissionUpdateRequest $request
     * @return JsonResponse
     */
    public function update(int $id, PermissionUpdateRequest $request): JsonResponse
    {
        return response()->json($this->permissionService->update($id, $request->validated()));
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        return response()->json($this->permissionService->delete($id));
    }
}
