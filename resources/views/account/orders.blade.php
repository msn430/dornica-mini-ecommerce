@php use App\Enums\OrderStatus; @endphp
@extends('account.layouts.app')

@section('account-content')
    <div class="flex flex-col shadow rounded-lg p-4 dark:bg-gray-800 bg-white mt-5 lg:mt-0">
               <span class="flex items-center justify-between">
                 <span class="flex items-center gap-x-2">
                    <img src="{{asset('assets/images/svg/status-delivered.svg')}}" class="w-10" alt="status-delivered">
                    <h2 class="font-DanaMedium text-lg">سفارش های من</h2>
                </span>
               </span>
        <div class="relative mt-5 overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700">
            <table class="w-full text-sm text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700  bg-gray-100 dark:bg-gray-900 dark:text-gray-200">
                <tr>
                    <th scope="col" class="px-6 py-3.5">
                        شماره پیگیری
                    </th>
                    <th scope="col" class="px-6 py-3.5">
                        تعداد محصول
                    </th>
                    <th scope="col" class="px-6 py-3.5">
                        تاریخ
                    </th>
                    <th scope="col" class="px-6 py-3.5">
                        قیمت
                    </th>
                    <th scope="col" class="px-6 py-3.5">
                        وضعیت
                    </th>
                </tr>
                </thead>
                <tbody>
                @forelse($userOrders as $order)
                    <tr class="bg-white border-b cursor-pointer dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all">
                        <td class="px-6 py-5">
                            {{$order->tracking_code}}
                        </td>
                        <td class="px-6 py-5">
                            {{$order->total_products}}
                        </td>
                        <td class="px-6 py-5">
                            {{$order->created_at->toJalali()->format('Y/m/d')}}
                        </td>
                        <td class="px-6 py-5">
                            {{number_format($order->total_price)}}
                        </td>
                        <td class="px-6 py-5 text-red-500 font-DanaDemiBold">
                            @switch($order->status)
                                @case(OrderStatus::PENDING)
                                    <span class="text-red-500">در انتظار پرداخت</span>
                                    @break
                                @case(OrderStatus::PROCESSING)
                                    <span class="text-red-500">در حال پردازش</span>
                                    @break
                                @case(OrderStatus::SENT)
                                    <span class="text-red-500">ارسال شده</span>
                                    @break
                                @case(OrderStatus::DELIVERED)
                                    <span class="text-red-500">تحویل شده</span>
                                    @break
                                @case(OrderStatus::REFUNDED)
                                    <span class="text-red-500">باز پرداخت شده</span>
                                    @break
                            @endswitch
                        </td>
                    </tr>
                @empty
                    @include('errors.404')
                @endforelse
                </tbody>
            </table>
        </div>
            <!-- PAGINATION -->
            <div class="flex flex-row-reverse justify-center mt-10 w-full" dir="rtl">
                {{$userOrders->links()}}
            </div>
    </div>
@endsection
