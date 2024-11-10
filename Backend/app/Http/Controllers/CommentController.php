<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Article;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $article = Article::find($id);
        $article->load('comments', 'user', 'tags', 'category');
        return view('livewire.comments.comments', compact('article'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find the comment by ID
        $comment = Comment::find($id);
        if ($comment) {
            $comment->delete();
            // Redirect back with a success message
            return redirect()->back()->with('success', __('Comment deleted successfully.'));
        } else {
            // Redirect back with an error message if the comment is not found
            return redirect()->back()->withErrors(['message' => __('Comment not found.')]);
        }
    }
}