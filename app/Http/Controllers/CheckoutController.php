<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutPostRequest;
use App\Services\CartService;
use App\Services\OrderService;
use Exception;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $title = "تکمیل اطلاعات خریدار";

        $userCart = CartService::getItemsWithDetails();

        $userCartTotalPrices = CartService::getTotalPrices();

        return view('checkout', compact('userCartTotalPrices', 'userCart', 'title'));
    }

    public function post(CheckoutPostRequest $request)
    {
        $checkoutData = $request->only([
            'user_province',
            'user_city',
            'user_address',
            'user_postal_code',
            'user_mobile',
            'description',
        ]);

//        try {
            OrderService::register($checkoutData);
//        }catch (Exception $exception){
//            return back()->withErrors(['error' => $exception->getMessage()])->withInput([
//                'user_province' => $checkoutData['user_province'],
//                'user_city' => $checkoutData['user_city'],
//                'user_address' => $checkoutData['user_address'],
//                'user_postal_code' => $checkoutData['user_postal_code'],
//                'user_mobile' => $checkoutData['user_mobile'],
//                'description' => $checkoutData['description'],
//            ]);
//        }

        return redirect()->route('account.orders');
    }
}
