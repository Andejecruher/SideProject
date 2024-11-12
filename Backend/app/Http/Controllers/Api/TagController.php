<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tag;

class TagController extends Controller
{
    /**
     * Display a listing of the tags that are in use with pagination.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // Get tags that are in use
        $tags = Tag::has('articles')->get(); // Assuming 'articles' is the relationship name

        // Response structure
        $response = [
            'data' => $tags,
            'message' => __('Tags retrieved successfully'),
        ];

        // Return the JSON response with tags in use
        return response()->json($response);
    }
}
