<?php

namespace App\Http\Controllers;

use App\Events\CommentSend;
use App\Models\UserComment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Notifications\Messages\BroadcastMessage;

class UserCommentController extends Controller
{
    public function show($id)
    {
        $comment = UserComment::findOrFail($id);

        return response()->json($comment);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $data  = $request->validate([
            'user_id'=>'required|int',
            'post_id'=>'required|int',
            'rating'=>'required|int',
            'title'=>'nullable|string|max:128',
            'text'=>'nullable|string|max:1024',
        ]);

        $userComment = new UserComment();
        $userComment['user_id'] = $data['user_id'];
        $userComment['post_id'] = $data['post_id'];
        $userComment['rating'] = $data['rating'];
        $userComment['title'] = $data['title'];
        $userComment['text'] = $data['text'];
        $userComment->save();

        broadcast(new CommentSend($userComment));

        return response()->json($userComment);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function delete($id): JsonResponse
    {
        $comment = UserComment::find($id);
        $comment->delete();

        return response()->json([
            'message'=>'Comment is successfully deleted'
        ], 200);
    }
}
