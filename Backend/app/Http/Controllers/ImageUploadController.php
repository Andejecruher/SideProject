<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageUploadController extends Controller
{
    /**
     * Constructor
     *
     * Apply middleware to protect routes with permissions.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:images.create', ['only' => ['store']]);
        $this->middleware('permission:images.destroy', ['only' => ['destroy']]);
    }
    /**
     * Handle the image upload request from CKEditor.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Check if the request has a file named 'upload'
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $originalFilename = $file->getClientOriginalName();
            $filename = time() . '_' . $originalFilename;

            // Check if a file with the same name already exists
            while (Storage::exists('public/editor/' . $filename)) {
                // If it exists, append a random string to the filename
                $filename = time() . '_' . uniqid() . '_' . $originalFilename;
            }

            // Store the file in the 'public/editor' directory
            $path = $file->storeAs('public/editor', $filename);

            // Get the URL of the stored file
            $url = Storage::url($path);

            // Return a JSON response with the URL of the uploaded file
            return response()->json([
                'uploaded' => true,
                'url' => $url
            ]);
        }

        // Return an error response if no file was uploaded
        return response()->json([
            'uploaded' => false,
            'error' => [
                'message' => 'No file uploaded.'
            ]
        ]);
    }
}
