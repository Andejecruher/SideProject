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
        // Get search, category, and pagination parameters
        $search = $request->input('search');
        $category = $request->input('category');
        $tag = $request->input('tag');
        $perPage = $request->input('per_page', 10); // Number of articles per page, default is 10

        // Build the query
        $query = Article::query()->with('category', 'tags', 'comments', 'user');

        // Apply search if a search term is provided
        if ($search) {
            $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%')
                ->orWhere('content', 'like', '%' . $search . '%');
        }

        // Apply category filter if a category is provided
        if ($category) {
            $query->where('category_id', $category);
        }

        // Apply tag filter if a tag is provided
        if ($tag) {
            $query->whereHas('tags', function ($query) use ($tag) {
                $query->where('tag_id', $tag);
            });
        }

        // Get paginated articles
        $articles = $query->paginate($perPage);

        // Response structure
        $response = [
            'data' => $articles->items(),
            'pagination' => [
                'current_page' => $articles->currentPage(),
                'per_page' => $articles->perPage(),
                'total_pages' => ceil($articles->total() / $articles->perPage()),
                'total_items' => $articles->total(),
            ],
            'message' => __('Articles retrieved successfully'),
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
        $article = Article::where('id', $id)->with('category', 'tags')->first();

        // Check if the article exists
        if (!$article) {
            return response()->json(['message' => __('Article not found')], 404);
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
                    'total_pages' => ceil($comments->total() / $comments->perPage()),
                    'total_items' => $comments->total(),
                ],
            ]
        ];

        // Return the JSON response with the article and its paginated comments
        return response()->json([
            'data' => $response,
            'message' => __('Article retrieved successfully'),
        ]);
    }

    /**
     * Display a listing of the latest articles.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function latest(Request $request)
    {
        // Get the number of latest articles to retrieve
        $limit = $request->input('limit', 5); // Default is 5

        // Get the latest articles based on publication_date
        $articles = Article::orderBy('publication_date', 'desc')->limit($limit)->get();

        $articles->load('category', 'tags');
        // Response structure
        $response = [
            'data' => $articles,
            'message' => __('Latest articles retrieved successfully'),
        ];

        // Return the JSON response with the latest articles
        return response()->json($response);
    }
}
