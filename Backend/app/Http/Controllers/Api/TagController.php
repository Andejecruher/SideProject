<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tag;

class TagController extends Controller
{
    /**
     * Display a listing of the tags with pagination.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // Get paginated tags
        $tags = Tag::all();

        // Response structure
        $response = [
            'data' => $tags,
            'message' => __('Tags retrieved successfully'),
        ];

        // Return the JSON response with paginated tags
        return response()->json($response);
    }
}
