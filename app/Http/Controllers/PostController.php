<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\UserComment;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        return response()->json($posts);
    }

    public function show($id)
    {
        $post = Post::find($id);

        $user = User::find($post->user_id);

        return response()->json([
            'post'=>$post,
            'creator'=>$user,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id'=>'required|int',
            'title' => 'required|string|min:5|unique:posts,title',
            'description' => 'nullable|string',
            'text' => 'nullable|string'
        ]);
        $post = new Post();
        $post['user_id'] = $data['user_id'];
        $post['title'] = $data['title'];
        $post['description'] = $data['description'];
        $post['text'] = $data['text'];

        $post->save();

        return response()->json($post);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title' => 'required|string|min:5',
            'description' => 'nullable|string',
            'text' => 'nullable|string'
        ]);

        $post = Post::find($id);
        $post->update($data);
        $post->save();

        return response()->json($post);
    }

    public function delete($id)
    {
        $post = Post::find($id);
        $post->delete();

        return response()->json(['message' => 'delete success']);
    }

    public function getComments($id)
    {
        $comments = UserComment::where('post_id', $id)
            ->orderBy('id', 'DESC')
            ->pluck('id');

        return response()->json($comments);
    }
}
