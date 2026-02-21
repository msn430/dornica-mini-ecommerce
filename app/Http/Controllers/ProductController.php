<?php

namespace App\Http\Controllers;

use App\Enums\productStatus;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::query()
            ->applySort()
            ->applyFilter()
            ->where('status', ProductStatus::ENABLE)
            ->paginate();



        $productCategories = ProductCategory::all();


        return view('products.index', compact('products', 'productCategories'));
    }

    public function show(Product $product)
    {
        $product->load('productCategory');

        return view('products.show', compact('product'));
    }
}
