<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
        // Get paginated categories
        $categories = Category::all();

        // Response structure
        $response = [
            'data' => $categories->items(),
            'message' => __('Categories retrieved successfully'),
        ];

        // Return the JSON response with paginated categories
        return response()->json($response);
    }
}
