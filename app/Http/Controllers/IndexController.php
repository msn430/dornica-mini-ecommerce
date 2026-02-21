<?php

namespace App\Http\Controllers;

use App\Enums\productStatus;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    //
    public function index()
    {
        $title = "صفحه اصلی";

        $productsCategories = $this->productsCategories();

        $newestProducts = $this->newestProducts();

        $bestSellingProducts = $this->bestSellingProducts();

//        dd($bestSellingProducts);
        return view('index', compact('title', 'productsCategories' , 'newestProducts', 'bestSellingProducts'));
    }

    private function productsCategories()
    {
        return ProductCategory::query()
            ->limit(8)
            ->get();
    }
    private function newestProducts()
    {
        return Product::query()
            ->orderByDesc('created_at')
            ->limit(8)
            ->get();
    }
    private function bestSellingProducts()
    {
        return Product::query()
            ->withSum('orderItems' ,'qty')
            ->orderByDesc('order_items_sum_qty')
            ->limit(8)
            ->get();
    }
}
