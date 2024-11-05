<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the categories with pagination.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // Get categories with the count of articles
        $categories = Category::withCount('articles')->get();

        // Response structure
        $response = [
            'data' => $categories,
            'message' => __('Categories retrieved successfully'),
        ];

        // Return the JSON response with paginated categories
        return response()->json($response);
    }
}
