<?php

namespace App\Http\Controllers;

use App\Events\CommentSend;
use App\Http\Requests\UserComment\UserCommentCreateRequest;
use App\Models\UserComment;
use App\Services\UserCommentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Notifications\Messages\BroadcastMessage;

class UserCommentController extends Controller
{
    public function __construct(private readonly UserCommentService $userCommentService)
    {
    }

    /**
     * @OA\Get(
     *     path="/comments/{id}",
     *     tags={"UserComments"},
     *     summary="Получить комментарий по ID",
     *     description="Возвращает комментарий по ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID комментария",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успешный ответ",
     *         @OA\JsonContent(ref="#/components/schemas/UserComment")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Комментарий не найден"
     *     )
     * )
     */
    public function show($id): JsonResponse
    {
        return response()->json($this->userCommentService->show($id));
    }

    /**
     * @OA\Post(
     *     path="/comments",
     *     tags={"UserComments"},
     *     summary="Создать новый комментарий",
     *     description="Создает новый комментарий для пользователя",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"user_id", "post_id", "title", "text"},
     *             @OA\Property(property="user_id", type="integer", example=1),
     *             @OA\Property(property="post_id", type="integer", example=1),
     *             @OA\Property(property="rating", type="integer", example=5),
     *             @OA\Property(property="title", type="string", example="Заголовок комментария"),
     *             @OA\Property(property="text", type="string", example="Текст комментария")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Комментарий успешно создан",
     *         @OA\JsonContent(ref="#/components/schemas/UserComment")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Ошибка валидации данных"
     *     )
     * )
     */
    public function store(UserCommentCreateRequest $request): JsonResponse
    {
        return response()->json($this->userCommentService->store($request->validated()));
    }

    /**
     * @OA\Delete(
     *     path="/comments/{id}",
     *     tags={"UserComments"},
     *     summary="Удалить комментарий",
     *     description="Удаляет комментарий по ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID комментария",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Комментарий успешно удалён",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Comment is successfully deleted")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Комментарий не найден"
     *     )
     * )
     */
    public function delete($id): JsonResponse
    {
        $this->userCommentService->delete($id);

        return response()->json([
            'message'=>'Comment is successfully deleted'
        ]);
    }
}
