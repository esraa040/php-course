<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $products = Product::all();
        return response()->json([
            "data" => $products,
            // "data"=>$products[0]['name'],
            "message" => "all data reterived successfully"
        ]);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        //

        $requestedData = $request->validated();
        $product = Product::create($requestedData);
        return response()->json([
            "data" => $product,
            // "data"=>$products[0]['name'],
            "message" => "producted added successfully"
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // ================= show category name ==========
        // $product = Product::with('category')->findorfail($id);
        $product = Product::findorfail($id);
        //   $category=Category::findorfail($product['category_id']);
        //   $categoryName=$product->category()->name;
        //   dd($product->category);
        // dd($product);
        if ($product) {

            return response()->json([
                "data" => $product, // data product + data category
                // "data"=>$product['name'],
                // "catedgoryName"=> $category['name'],
                "catedgoryName"=> $product->category->name,
                "message" => "all data reterived successfully"

            ]);
        } else {
            return response()->json([

                "message" => "product not found"
            ]);
        }
    }
// public function show(string $id)
// {
//     $product = Product::with('category')->findOrFail($id);

//     return response()->json([
//         "data" => $product,
//         "categoryName" => $product->category?->name,
//         "message" => "Product retrieved successfully"
//     ]);
// }


    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        //
        $product = Product::findorfail($id);
        $requestedData = $request->validated();
        $product->update($requestedData);
        return response()->json([
            "data" => $product,
            // "data"=>$product['name'],
            "message" => "product updated successfully"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $product = Product::findorfail($id);
        $product->delete();
        return response()->json([
            "data" => $product,
            // "data"=>$product['name'],
            "message" => "product deleted successfully"
        ]);
    }
}
