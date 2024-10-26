<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the articles with pagination and search.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        // Get search and pagination parameters
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10); // Number of articles per page, default is 10

        // Build the query
        $query = Article::query();

        // Apply search if a search term is provided
        if ($search) {
            $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%')
                ->orWhere('content', 'like', '%' . $search . '%');
        }

        // Get paginated articles
        $articles = $query->paginate($perPage);

        // Response structure
        $response = [
            'data' => $articles->items(),
            'pagination' => [
                'current_page' => $articles->currentPage(),
                'per_page' => $articles->perPage(),
                'links' => [
                    'prev_page_url' => $articles->previousPageUrl(),
                    'next_page_url' => $articles->nextPageUrl(),
                ],
                'total_pages' => ceil($articles->total() / $articles->perPage()),
                'total_items' => $articles->total(),
            ],
        ];

        // Return the JSON response with paginated articles
        return response()->json($response);
    }

    /**
     * Display the specified article.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id, Request $request)
    {
        // Find the article by ID
        $article = Article::find($id);

        // Check if the article exists
        if (!$article) {
            return response()->json(['message' => 'Article not found'], 404);
        }

        // Get pagination parameters
        $perPage = $request->input('per_page', 10); // Number of comments per page, default is 10

        // Get paginated comments for the article
        $comments = $article->comments()->paginate($perPage);

        // Response structure
        $response = [
            'article' => $article,
            'comments' => [
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
            ],
        ];

        // Return the JSON response with the article and its paginated comments
        return response()->json($response);
    }
}
