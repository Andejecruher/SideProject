<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{

    /**
     * Show the form for editing the specified category.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        // Find the category by ID
        $category = Category::find($id);
        if (!$category) {
            return redirect()->back()
                    ->withErrors(['message' => __('Category not found')])
                    ->withInput();
        }

        // Return the edit form view with the category data
        return view('livewire.categories.form', compact('category'));
    }

    /**
     * Show the form for creating a new category.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Return the create form view
        return view('livewire.categories.form');
    }

    /**
     * Store a newly created category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:categories,name',
            'description' => 'required|string',
            'icon' => 'required|string',
            'color' => 'required|string',
        ]);

        // If validation fails, return a response with errors
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Create a new category with the validated data
        Category::create($request->only('name', 'description', 'color', 'icon'));

        // Redirect to the categories list with a success message
        return redirect()->route('categories-list')->with('success', __('Category created successfully'));
    }


    /**
     * Update the specified category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Find the category by ID
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['message' => __('Category not found')], 404);
        }

        // Validate the request data
        $validator = Validator::make($request->all(), [
            'name' => 'string|unique:categories,name,' . $id,
            'description' => 'string',
            'icon' => 'string',
            'color' => 'string',
        ]);

        // If validation fails, return a response with errors
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Update the category with the validated data
        $category->update($request->only('name', 'description', 'color', 'icon'));

        // Redirect to the categories list with a success message
        return redirect()->route('categories-list')->with('success', __('Category updated successfully'));
    }

    /**
     * Remove the specified category from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        // Find the category by ID
        $category = Category::find($id);
        if ($category) {
            // Delete the category
            $category->delete();
        }

        // Redirect to the categories list with a success message
        return redirect()->route('categories-list')->with('success', __('Category deleted successfully'));
    }
}
