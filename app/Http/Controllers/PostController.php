<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\PostCreateRequest;
use App\Http\Requests\Post\PostUpdateRequest;
use App\Services\PostService;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{

    public function __construct(private readonly PostService $postService)
    {
    }

    /**
     * @OA\Get(
     *     path="/posts",
     *     tags={"Posts"},
     *     summary="Получить список всех постов",
     *     description="Возвращает список всех постов",
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
    public function index(): JsonResponse
    {
        return response()->json($this->postService->all());
    }

    /**
     * @OA\Get(
     *     path="/posts/{id}",
     *     tags={"Posts"},
     *     summary="Получить пост по ID",
     *     description="Возвращает данные поста по его ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID поста",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успешный ответ",
     *         @OA\JsonContent(ref="#/components/schemas/Post")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Пост не найден"
     *     )
     * )
     */
    public function show(int $id): JsonResponse
    {
        return response()->json($this->postService->show($id));
    }

    /**
     * @OA\Post(
     *     path="/posts",
     *     tags={"Posts"},
     *     summary="Создать новый пост",
     *     description="Создаёт новый пост и возвращает его данные",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title", "description", "text", "user_id"},
     *             @OA\Property(property="title", type="string", example="Название поста"),
     *             @OA\Property(property="description", type="string", example="Краткое описание"),
     *             @OA\Property(property="text", type="string", example="Содержимое поста"),
     *             @OA\Property(property="user_id", type="integer", example=5),
     *             @OA\Property(property="icon", type="string", example="image.png")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Пост создан",
     *         @OA\JsonContent(ref="#/components/schemas/Post")
     *     )
     * )
     */
    public function store(PostCreateRequest $request): JsonResponse
    {
        return response()->json($this->postService->store($request->validated()));
    }

    /**
     * @OA\Patch(
     *     path="/posts/{id}",
     *     tags={"Posts"},
     *     summary="Обновить пост",
     *     description="Обновляет данные поста по его ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID поста",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title", "description", "text"},
     *             @OA\Property(property="title", type="string", example="Обновлённое название"),
     *             @OA\Property(property="description", type="string", example="Обновлённое краткое описание"),
     *             @OA\Property(property="text", type="string", example="Обновлённое содержимое"),
     *             @OA\Property(property="icon", type="string", example="updated_image.png")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Пост обновлён",
     *         @OA\JsonContent(ref="#/components/schemas/Post")
     *     )
     * )
     */
    public function update(PostUpdateRequest $request, int $id): JsonResponse
    {
        return response()->json($this->postService->update($request->validated(), $id));
    }

    /**
     * @OA\Delete(
     *     path="/posts/{id}",
     *     tags={"Posts"},
     *     summary="Удалить пост",
     *     description="Удаляет пост по его ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID поста",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Пост удалён"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Пост не найден"
     *     )
     * )
     */
    public function delete(int $id): JsonResponse
    {
        return response()->json($this->postService->delete($id));
    }

    /**
     * @OA\Get(
     *     path="/posts/{id}/comments",
     *     tags={"Posts"},
     *     summary="Получить комментарии к посту",
     *     description="Возвращает список комментариев для указанного поста",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID поста",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успешный ответ",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/UserComment")
     *         )
     *     )
     * )
     */
    public function getComments(int $id): JsonResponse
    {
        return response()->json($this->postService->getCommentsByID($id));
    }
}
