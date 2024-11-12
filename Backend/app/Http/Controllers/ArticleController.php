<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;

class ArticleController extends Controller
{

    /**
     * Constructor
     *
     * Apply middleware to protect routes with permissions.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:articles.index', ['only' => ['index']]);
        $this->middleware('permission:articles.show', ['only' => ['show']]);
        $this->middleware('permission:articles.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:articles.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:articles.destroy', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the articles.
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $article = Article::find($id); // Find the article by ID
        return view('livewire.articles.show', ['article' => $article]); // Return the article view with the article data
    }


    /**
     * Show the form for creating a new article.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $categories = Category::all(); // Get all categories
        $tags = Tag::all(); // Get all tags
        return view('livewire.articles.form', compact('categories', 'tags'));
    }

    /**
     * Show the form for editing the specified article.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\View\View
     */
    public function edit(Article $article)
    {
        $categories = Category::all(); // Get all categories
        $tags = Tag::all(); // Get all tags
        return view('livewire.articles.form', compact('article', 'categories', 'tags'));
    }

    /**
     * Store a newly created article in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate form data
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'required|string',
            'content' => 'required|string',
            'featured_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'category_id' => 'required|exists:categories,id'
        ]);

        // If validation fails, redirect back with errors and input
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Get tags from the request
        $tags = $request->input('tags') ? explode(',', $request->input('tags')) : [];

        // Handle featured_image upload
        $featuredImageName = null;
        if ($request->hasFile('featured_image')) {
            $file = $request->file('featured_image');
            $featuredImageName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/featured_image', $featuredImageName);
        }

        // Handle thumbnail upload
        $thumbnailName = null;
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $thumbnailName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/thumbnail', $thumbnailName);
        }

        // Create the article
        $article = Article::create([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'featured_image' => $featuredImageName,
            'thumbnail' => $thumbnailName,
            'publication_date' => now(),
            'user_id' => auth()->user()->id,
            'category_id' => $request->category_id,
        ]);

        // Attach tags to the article
        if ($tags) {
            $tagsAux = Tag::find($tags);
            $article->tags()->attach($tagsAux);
        }

        // Redirect to the articles list with a success message
        return redirect()->route('articles-list')->with('success', __('Article created successfully.'));
    }

    /**
     * Update the specified article in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Article $article)
    {
        // Get tags from the request
        $tags = $request->input('tags') ? explode(',', $request->input('tags')) : [];

        // Validate form data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'featured_image' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        // Handle featured_image upload
        if ($request->hasFile('featured_image')) {
            // Delete old featured_image if exists
            if ($article->featured_image) {
                Storage::delete('public/featured_image/' . $article->featured_image);
            }

            // Generate a unique name for the new featured_image
            $file = $request->file('featured_image');
            $filename = time() . '_' . $file->getClientOriginalName();

            // Store new featured_image with the unique name
            $featuredImagePath = $file->storeAs('public/featured_image', $filename);
            $article->featured_image = basename($featuredImagePath);
        }

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail if exists
            if ($article->thumbnail) {
                Storage::delete('public/thumbnail/' . $article->thumbnail);
            }

            // Generate a unique name for the new thumbnail
            $file = $request->file('thumbnail');
            $filename = time() . '_' . $file->getClientOriginalName();

            // Store new thumbnail with the unique name
            $thumbnailPath = $file->storeAs('public/thumbnail', $filename);
            $article->thumbnail = basename($thumbnailPath);
        }

        // Update other fields
        $article->title = $request->input('title');
        $article->description = $request->input('description');
        $article->content = $request->input('content');
        $article->category_id = $request->input('category_id');

        // Update tags
        if ($tags) {
            $tagsAux = Tag::find($tags);
            $article->tags()->sync($tagsAux);
        } else {
            $article->tags()->detach();
        }

        // Save the updated article
        $article->save();

        // Redirect to the articles list with a success message
        return redirect()->route('articles-list')->with('success', __('Article updated successfully.'));
    }

    /**
     * Remove the specified article from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // Find the article by ID
        $article = Article::find($id);
        if ($article) {
            // Delete associated images
            if ($article->featured_image) {
                Storage::delete('public/featured_image/' . $article->featured_image);
            }
            if ($article->thumbnail) {
                Storage::delete('public/thumbnail/' . $article->thumbnail);
            }

            // Detach tags and delete the article
            $article->tags()->detach();
            $article->delete();

            // Redirect to the articles list with a success message
            return redirect()->route('articles-list')->with('success', __('Article deleted successfully.'));
        } else {
            // Redirect to the articles list with an error message if the article is not found
            return redirect()->route('articles-list')->withErrors(['message' => __('Article not found.')]);
        }
    }
}
