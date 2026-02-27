<?php

use App\Models\Order;
use App\Services\CartService;
use App\Services\OrderService;

if (!function_exists('calcPercent')) {

    function calcPercent(int|float $total, int|float $amount): int|float
    {
        return abs(($amount * 100) / $total);
    }
}
if (!function_exists('activeSort')) {

    function activeSort(string $type): ?string
    {
        $request = request();

        $default = 'newest';

        if (!$request->filled('sort')) {
            if ($type == $default) {
                return 'text-blue-500';
            }
            return null;
        }

        return $request->input('sort') == $type ? 'text-blue-500' : 'text-gray-400';
    }
}
if (!function_exists('generateSortRouteParameter')) {

    function generateSortRouteParameter(string $type): array
    {
        $request = request();

        $queries = $request->all();

        $queries['sort'] = $type;

        return $queries;

//            ['sort' => 'newest']
    }
}
if (!function_exists('generateFilterRouteParameter')) {
    function generateFilterRouteParameter(string $type): array
    {
        $request = request();

        $queries = $request->all();

        $queries['filter'] = $type;

        return $queries;

    }
}
if (!function_exists('getUserFullName')) {
    function getUserFullName(): string
    {
        return auth()->user()->first_name . ' ' . auth()->user()->last_name;

    }
}
if (!function_exists('activeAccountSidebar')) {
    function activeAccountSidebar(string $routeName): string
    {
//        bg-blue-500/10 text-blue-500
//        hover:text-blue-500
        if (Route::currentRouteName() == $routeName) {
            return 'bg-blue-500/10 text-blue-500';
        } else {
            return 'hover:text-blue-500';
        }
    }
}

if (!function_exists('getUserCartCount')) {
    function getUserCartCount(): int
    {
        return CartService::getCount();
    }

}

if (!function_exists('getQtySync')) {
    function getQtySync(int $productId): int
    {
        return CartService::getCartProductQty($productId);
    }
}
if (!function_exists('getUserOrdersCount')) {
    function getUserOrdersCount(): int
    {
        return OrderService::getOrderCount();
    }
}

