<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    //
    public function index()
    {
        $title = 'سفارشات من';

        $userOrders = Order::where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->paginate(6);


            return view('account.orders', compact('title', 'userOrders'));
    }

}
