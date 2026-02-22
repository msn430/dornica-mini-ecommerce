<?php

if (!function_exists('calcPercent')) {

    function calcPercent(int|float $total, int|float $amount): float
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

