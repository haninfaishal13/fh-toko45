<?php

namespace App\Http\Controllers\Frontsite;

use App\Helpers\ProductHelper;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getData(Request $request)
    {
        $product = ProductHelper::getProductData($request->all())->paginate(12);
        return response()->json([
            'success' => true,
            'data' => $product
        ]);
    }
}
