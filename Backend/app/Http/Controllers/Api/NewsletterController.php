<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Newsletter;

class NewsletterController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:newsletter,email'
        ]);

        $newsletter = new Newsletter;
        $newsletter->email = $request->email;
        $newsletter->save();

        return response()->json([
            'message' => __('Successfully subscribed to newsletter.')
        ]);
    }
}
