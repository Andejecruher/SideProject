<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentsController extends Controller
{
    // Listar todos los comentarios de un artículo específico
    public function index($articleId)
    {
        $comments = Comment::where('article_id', $articleId)->get();
        return response()->json([
            'data' => $comments->items(),
            'pagination' => [
                'current_page' => $comments->currentPage(),
                'per_page' => $comments->perPage(),
                'links' => [
                    'prev_page_url' => $comments->previousPageUrl(),
                    'next_page_url' => $comments->nextPageUrl(),
                ],
                'total_pages' => ceil($comments->total() / $comments->perPage()),
                'total_items' => $comments->total(),
            ],
            'message' => __('Comments retrieved successfully'),
        ]);
    }

    // Crear un nuevo comentario para un artículo específico
    public function store(Request $request, $articleId)
    {
        $request->validate([
            'content' => 'required|string|max:255',
            'author_name' => 'required|string',
            'author_email' => 'required|email',
            'ip_address' => 'required|ip',
            'article_id' => 'required|integer|exists:articles,id',
        ]);

        $comment = new Comment();
        $comment->content = $request->input('content');
        $comment->author_name = $request->input('author_name');
        $comment->author_email = $request->input('author_email');
        $comment->ip_address = $request->input('ip_address');
        $comment->article_id = $articleId;
        $comment->published_at = now();
        $comment->save();

        return response()->json([
            'data' => $comment,
            'message' => __('Comment created successfully'),
        ]);
    }

    // Mostrar un comentario específico de un artículo
    public function show($articleId, $id)
    {
        $comment = Comment::where('article_id', $articleId)->where('id', $id)->first();

        if (is_null($comment)) {
            return response()->json(['message' => __('Comment not found')], 404);
        }

        return response()->json([
            'data' => $comment,
            'message' => __('Comment retrieved successfully'),
        ]);
    }

    // Actualizar un comentario específico de un artículo
    public function update(Request $request, $articleId, $id)
    {
        $request->validate([
            'content' => 'required|string|max:255',
            'author_name' => 'required|string',
            'author_email' => 'required|email',
            'ip_address' => 'required|ip',
            'article_id' => 'required|integer|exists:articles,id',
        ]);

        $comment = Comment::where('article_id', $articleId)->where('id', $id)->first();

        if (is_null($comment)) {
            return response()->json(['message' => __('Comment not found')], 404);
        }

        $comment->update($request->all());
        return response()->json([
            'data' => $comment,
            'message' => __('Comment updated successfully'),
        ]);
    }

    // Eliminar un comentario específico de un artículo
    public function destroy($articleId, $id)
    {
        $comment = Comment::where('article_id', $articleId)->where('id', $id)->first();

        if (is_null($comment)) {
            return response()->json(['message' => __('Comment not found')], 404);
        }

        $comment->delete();
        return response()->json([
            'data' => $comment,
            'message' => __('Comment deleted successfully')
        ]);
    }
}
