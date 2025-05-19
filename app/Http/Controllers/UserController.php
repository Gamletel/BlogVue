<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserUpdateRequest;
use App\Models\Post;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(private readonly UserService $userService)
    {
    }

    /**
     * @OA\Get(
     *     path="/users",
     *     tags={"Users"},
     *     summary="Получить список всех пользователей",
     *     description="Возвращает список всех пользователей",
     *     @OA\Response(
     *         response=200,
     *         description="Успешный ответ",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/User")
     *         )
     *     )
     * )
     */
    public function index(): JsonResponse
    {
        return response()->json($this->userService->all());
    }

    public function profile(Request $request): JsonResponse
    {
        $user = $request->user();

        if ($user) {
            return response()->json($user);
        }else{
            return response()->json(["message" => "Unauthenticated"], 401);
        }
    }

    /**
     * @OA\Get(
     *     path="/users/{id}",
     *     tags={"Users"},
     *     summary="Получить данные пользователя по ID",
     *     description="Возвращает информацию о пользователе по его ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID пользователя",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успешный ответ",
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Пользователь не найден"
     *     )
     * )
     */
    public function show(int $id): JsonResponse
    {
        $model = $this->userService->show($id);
        if (!$model) {
            return response()->json(["message" => "User not found"], 404);
        }
        return response()->json($model);
    }

    /**
     * @OA\Put(
     *     path="/users/{id}",
     *     tags={"Users"},
     *     summary="Обновить данные пользователя",
     *     description="Обновляет информацию пользователя по его ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID пользователя",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "email"},
     *             @OA\Property(property="name", type="string", example="John Doe"),
     *             @OA\Property(property="email", type="string", example="johndoe@example.com"),
     *             @OA\Property(property="avatar", type="string", example="new_avatar.png")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Пользователь обновлён",
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     )
     * )
     */
    public function update(UserUpdateRequest $request, $id): JsonResponse
    {
        return response()->json($this->userService->update($request, $id));
    }

    /**
     * @OA\Get(
     *     path="/users/{id}/posts",
     *     tags={"Users"},
     *     summary="Получить посты пользователя",
     *     description="Возвращает все посты пользователя по его ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID пользователя",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успешный ответ",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Post")
     *         )
     *     )
     * )
     */
    public function postsByUser($id): JsonResponse
    {
        $posts = Post::where('user_id', $id)->get();

        return response()->json($posts);
    }
}
