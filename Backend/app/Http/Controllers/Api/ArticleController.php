<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        // Obtener los parámetros de búsqueda y paginación
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10); // Número de artículos por página, por defecto 10

        // Construir la consulta
        $query = Article::query();

        // Aplicar búsqueda si se proporciona un término de búsqueda
        if ($search) {
            $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%')
                ->orWhere('content', 'like', '%' . $search . '%');
        }

        // Obtener los artículos paginados
        $articles = $query->paginate($perPage);

        // Estructura de respuesta
        $response = [
            'data' => $articles->items(),
            'current_page' => $articles->currentPage(),
            'per_page' => $articles->perPage(),
            'links' => [
                'prev_page_url' => $articles->previousPageUrl(),
                'next_page_url' => $articles->nextPageUrl(),
            ],
            'total_pages' => ceil($articles->total() / $articles->perPage()),
            'total_items' => $articles->total(),
        ];

        // Devolver la respuesta JSON con los artículos paginados
        return response()->json($response);
    }

    /**
     * Display the specified article.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $article = Article::find($id);

        if (!$article) {
            return response()->json(['message' => 'Article not found'], 404);
        }

        return response()->json($article);
    }
}
