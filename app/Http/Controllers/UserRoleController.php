<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRole\UserRoleCreateRequest;
use App\Http\Requests\UserRole\UserRoleUpdateRequest;
use App\Services\UserRoleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    /**
     * @param UserRoleService $userRoleService
     */
    public function __construct(private readonly UserRoleService $userRoleService)
    {
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json($this->userRoleService->index());
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        return response()->json($this->userRoleService->show($id));
    }

    /**
     * @param UserRoleCreateRequest $request
     * @return JsonResponse
     */
    public function store(UserRoleCreateRequest $request): JsonResponse
    {
        return response()->json($this->userRoleService->store($request->validated()));
    }

    /**
     * @param int $id
     * @param UserRoleUpdateRequest $request
     * @return JsonResponse
     */
    public function update(int $id, UserRoleUpdateRequest $request): JsonResponse
    {
        return response()->json($this->userRoleService->update($id, $request->validated()));
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        return response()->json($this->userRoleService->destroy($id));
    }
}
