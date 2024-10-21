<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index(Request $request)
    {
        $query = Article::with('tags', 'comments', 'category', 'user');
        // Apply search filters if provided in the query
        if ($request->has('title')) {
            $query->where('title', 'like', '%' . $request->input('title') . '%');
        }
        if ($request->has('description')) {
            $query->where('description', 'like', '%' . $request->input('description') . '%');
        }
        if ($request->has('content')) {
            $query->where('content', 'like', '%' . $request->input('content') . '%');
        }
        $itemsPerPage = $request->input('per_page', 10);
        $currentPage = $request->input('current_page', 1);
        $articles = $query->paginate($itemsPerPage, ['*'], 'page', $currentPage);
        return response()->json($articles, 200);
    }

    public function show($id)
    {
        $article = Article::with('tags', 'comments', 'category', 'user')->find($id);
        if ($article) {
            return response()->json($article, 200);
        } else {
            return response()->json(['message' => 'Article not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'required|string',
            'content' => 'required|string',
            'featured_image' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Invalid data', 'errors' => $validator->errors()], 422);
        }
        $article = Article::create([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'featured_image' => $request->featured_image,
            'publication_date' => now(),
            'user_id' => auth()->user()->id,
            'category_id' => $request->category_id,
        ]);

        if ($request->has('tags')) {
            $tags = Tag::find($request->tags);
            $article->tags()->attach($tags);
        }

        return response()->json($article, 201);
    }

    public function update(Request $request, $id)
    {
        $article = Article::find($id);
        if (!$article) {
            return response()->json(['message' => 'Article not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'string',
            'content' => 'required|string',
            'featured_image' => 'string',
            'category_id' => 'exists:categories,id',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Invalid data', 'errors' => $validator->errors()], 422);
        }

        $article->update($request->only(['title', 'content', 'description', 'featured_image', 'category_id']));

        if ($request->has('tags')) {
            $tags = Tag::find($request->tags);
            $article->tags()->sync($tags);
        }

        return response()->json($article, 200);
    }

    public function destroy($id)
    {
        $article = Article::find($id);
        if ($article) {
            $article->tags()->detach();
            $article->delete();
            return response()->json(['message' => 'Article deleted'], 200);
        } else {
            return response()->json(['message' => 'Article not found'], 404);
        }
    }
}
