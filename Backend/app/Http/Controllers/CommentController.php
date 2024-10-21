<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index()
    {
        $comments = Comment::with('user')->paginate();
        return response()->json($comments, 200);
    }

    public function show($id)
    {
        $comment = Comment::find($id);
        if ($comment) {
            return response()->json($comment, 200);
        } else {
            return response()->json(['message' => 'Comment not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required|string',
            'article_id' => 'required|exists:articles,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Invalid data', 'errors' => $validator->errors()], 422);
        }

        $comment = Comment::create([
            'content' => $request->content,
            'article_id' => $request->article_id,
            'author_name' => auth()->user()->name,
            'user_id' => auth()->user()->id,
            'ip_address' => $request->ip(),
        ]);

        return response()->json($comment, 201);
    }

    public function update(Request $request, $id)
    {
        $comment = Comment::find($id);
        if (!$comment) {
            return response()->json(['message' => 'Comment not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'content' => 'string',
            'article_id' => 'exists:articles,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Invalid data', 'errors' => $validator->errors()], 422);
        }

        $comment->update($request->only(['content', 'article_id']));

        return response()->json($comment, 200);
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);
        if ($comment) {
            $comment->delete();
            return response()->json(['message' => 'Comment deleted'], 200);
        } else {
            return response()->json(['message' => 'Comment not found'], 404);
        }
    }
}
