<?php

namespace App\Http\Controllers\Api;

use App\Models\Collection;
use App\Models\Currency;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;

class ProductsController extends Controller
{
    //
    public function index(Request $request)
    {
        $request->validate(['category_id' => 'required|integer']);
        $products = Product::query()
        ->where(['category_id' => $request->input('category_id'), 'on_sale' => true])
        ->where('stock', '>', 0)
        ->orderBy('id', 'DESC')
        ->get();

        return response()->json(['data' => $products]);
    }

    public function show(Product $product)
    {
        $product->image = check_url($product->image);
        return response()->json(['data' => $product]);
    }
}
