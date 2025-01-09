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
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        return response()->json($this->userCommentService->show($id));
    }

    /**
     * @param UserCommentCreateRequest $request
     * @return JsonResponse
     */
    public function store(UserCommentCreateRequest $request): JsonResponse
    {
        return response()->json($this->userCommentService->store($request->all()));
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function delete($id): JsonResponse
    {
        $this->userCommentService->delete($id);

        return response()->json([
            'message'=>'Comment is successfully deleted'
        ]);
    }
}
