<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function selectCategoryToko()
    {
        $category = Category::select('id', 'name as text')->where('section', 'toko')->get();
        return response()->json([
            'success' => true,
            'data' => $category
        ]);
    }

    public function selectCategoryLaundry()
    {
        $category = Category::select('id', 'name as text')->where('section', 'toko')->get();
        return response()->json([
            'success' => true,
            'data' => $category
        ]);
    }

    public function selectProduct(Request $request)
    {
        $product = Product::select('id', 'name as text')->where('category_id', $request->category_id)->get();
        return response()->json([
            'success' => true,
            'data' => $product
        ]);
    }

    // public function getProduct(Request $request)
    // {
    //     $product = Product::find($id);
    //     return response()->json([
    //         'success' => true,
    //         'data' => $product
    //     ]);
    // }
}
