<?php

namespace App\Services;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Models\OrderItem;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OrderService
{
    public static function getOrderCount() : int
    {
        $userId = Auth::id();
        return Order::where('user_id', $userId)
            ->count();
    }
    public static function register(array $checkoutData)
    {
        $cartItems = CartService::getItemsWithDetails();
        $cartTotalPrices = CartService::getTotalPrices();

        //Check Product qty
        foreach ($cartItems as $cartItem) {
            if ($cartItem['qty'] > $cartItem['product']->qty) {
                throw new Exception("متاسفانه محصول " . $cartItem['product']->name . " موجودی ندارد!");
            }
        }

        // Dec Product qty
        foreach ($cartItems as $cartItem) {
            $cartItem['product']->decrement('qty', $cartItem['qty']);
        }

        // Create order
        $orderData = [
            'user_id' => Auth::id(),
            'total_price' => $cartTotalPrices['final_price'],
            'total_discount' => $cartTotalPrices['final_discount'],
            'total_products' => CartService::getCount(),
            'tracking_code' => "TKC_" . date('Hi') . Str::random(4) . date('md') . mt_rand(00,99) ,
            'status' => OrderStatus::PROCESSING
        ];

        $order = Order::create(array_merge($orderData, $checkoutData));

        // Create order item
        foreach ($cartItems as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem['product_id'],
                'qty' => $cartItem['qty'],
                'price' => $cartItem['product']->price,
                'total_price' => $cartItem['product']->price * $cartItem['qty'],
                'discount' => $cartItem['product']->discount,
                'total_discount' => $cartItem['product']->discount * $cartItem['qty'],
            ]);
        }
        session()->forget('cart');
    }
}
