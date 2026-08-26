<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return response()->json([
            "data" => $categories,
            "message" => "all data reterived successfully"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $requestedData = $request->validated();
        $category = Category::create($requestedData);
        return response()->json([
            "data" => $category,
            "message" => "category added successfully"
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::with('products')->findorfail($id);
        return response()->json([
            "data" => $category,
            "products" => $category->products,
            "message" => "all data reterived successfully"
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        $category = Category::findorfail($id);
        $requestedData = $request->validated();
        $category->update($requestedData);
        return response()->json([
            "data" => $category,
            "message" => "category updated successfully"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findorfail($id);
        $category->delete();
        return response()->json([
            "data" => $category,
            "message" => "category deleted successfully"
        ]);
    }
}
