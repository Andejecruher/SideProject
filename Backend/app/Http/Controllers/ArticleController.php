<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Category;

class ArticleController extends Controller
{
    public function create()
    {
        $categories = Category::all(); // Obtener todas las categorías
        return view('livewire.articles.form', compact('categories'));
    }

    public function edit(Article $article)
    {
        $categories = Category::all(); // Obtener todas las categorías
        return view('livewire.articles.form', compact('article', 'categories'));
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
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
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

        return redirect()->route('articles-list')->with('success', __('Article created successfully.'));
    }

    public function update(Request $request, $id)
    {
        $article = Article::find($id);
        if (!$article) {
            return redirect()->back()
                    ->withErrors(['message' => __('Article not found')])
                    ->withInput();
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
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $article->update($request->only(['title', 'content', 'description', 'featured_image', 'category_id']));

        if ($request->has('tags')) {
            $tags = Tag::find($request->tags);
            $article->tags()->sync($tags);
        }

        return redirect()->route('articles-list')->with('success', __('Article updated successfully.'));
    }

    public function destroy($id)
    {
        $article = Article::find($id);
        if ($article) {
            $article->tags()->detach();
            $article->delete();
            return redirect()->route('articles-list')->with('success', __('Article deleted successfully.'));
        } else {
            return redirect()->route('articles-list')->withErrors(['message' => __('Article not found.')]);
        }
    }
}
