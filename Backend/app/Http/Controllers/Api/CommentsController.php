<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Article;

class CommentsController extends Controller
{
    // Listar todos los comentarios de un artículo específico
    public function index(Request $request, $articleId)
    {
        $perPage = $request->input('per_page', 10);

        $comments = Comment::where('article_id', $articleId)->where('approved', true)->get();
        $comments = $comments->paginate($request->input($perPage, 5));

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
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:255',
            'author_name' => 'required|string',
            'author_email' => 'required|email',
            'article_id' => 'required|integer|exists:articles,id',
            'ip_address' => 'ip',
            'article_id' => 'required|integer|exists:articles,id',
        ]);
        // Obtener la dirección IP del cliente
        $ipAddress = $request->ip();
        $comment = new Comment();
        $comment->content = $request->input('content');
        $comment->author_name = $request->input('author_name');
        $comment->author_email = $request->input('author_email');
        $comment->ip_address = $ipAddress;
        $comment->article_id = $request->input('article_id');
        $comment->published_at = '';
        $comment->save();

        $article = Article::where('id', $request->input('article_id'))->with('category', 'tags', 'user')->first();

        // Check if the article exists
        if (!$article) {
            return response()->json(['message' => __('Article not found')], 404);
        }

        $article->comments = $article->comments()->paginate(5);


        // Return the JSON response with the article and its paginated comments
        return response()->json([
            'data' => $article,
            'message' => __('Article retrieved successfully and comment created'),
        ]);
    }

    // Mostrar un comentario específico de un artículo
    public function show($articleId, $id)
    {
        $comment = Comment::where('article_id', $articleId)->where('approved', true)->where('id', $id)->first();

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
            'ip_address' => 'ip',
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
