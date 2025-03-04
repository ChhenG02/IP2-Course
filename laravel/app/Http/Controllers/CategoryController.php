<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getCategories()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createCategory(Request $request)
    {
        $category = Category::create([
            'name' => $request->name,
        ]);
        return response()->json(['message' => 'Creating a new category', 'category' => $category]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function getCategory( $categoryId)
    {
        $category = Category::find($categoryId);
        return response()->json($category);
    }

    /**
     * Display the specified resource.
     */
    public function updateCategory(Request $request, $categoryId)
    {
        $category = Category::find($categoryId);

        $category->update($request -> all());
        return response()->json(['message' => 'Category updated successfully', 'category' => $category]);
    }

    public function deleteCategory( $categoryId)
    {
        $category = Category::find($categoryId);
        $category->delete();
        return response()->json(['message' => 'Category deleted successfully']);
    }

}