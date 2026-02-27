@php use App\Services\CartService; @endphp
@extends('layout.app')

@section('content')
    <main class="container">
        <!-- Breadcrumb -->
        <nav class="flex mt-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="{{route('index')}}"
                       class="inline-flex items-center text-sm gap-x-1  text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                        <svg class="size-4 mb-0.5">
                            <use href="#home"/>
                        </svg>
                        صفحه اصلی
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="m1 9 4-4-4-4"/>
                        </svg>
                        <span class="ms-1 text-sm  text-gray-500 md:ms-2 dark:text-gray-400">سبد خرید</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- shopping cart -->
        <section
            class="flex flex-col lg:flex-row justify-between items-start gap-4 child:rounded-lg child:bg-white child:dark:bg-gray-800 child:shadow child:p-4 mt-5">
            <!-- products -->
            <div class="w-full  lg:w-3/4  flex flex-col gap-y-8 ">
                <!-- shopping cart header -->
                <div class="flex items-center justify-between">
                    <span class="flex items-center gap-x-2">
                        <h2 class="font-DanaMedium text-xl">سبد خرید</h2>
                                                    <p class="text-gray-400">
                                (
                                {{getUserCartCount()}}
                                کالا
                                )
                            </p>
                    </span>
                    @if(getUserCartCount() > 0)
                        <a href="{{route('cart.clear')}}"
                           class="flex items-center gap-x-1 text-red-600 dark:text-white cursor-pointer">
                            <p class="mt-1 font-DanaMedium ">حذف همه</p>
                            <svg class="w-5 h-5">
                                <use href="#trash"></use>
                            </svg>
                        </a>
                    @endif
                </div>


                <!-- PRODUCT ITEMS -->
                <form action="{{route('cart.update-qty')}}" method="POST">
                    @csrf
                    <div
                        class="w-full flex flex-col gap-y-4 child:p-2 lg:child:p-4"
                    >

                        <!-- PRODUCT ITEM -->
                        @forelse($userCartItems as $cartItem)
                            <div
                                class="w-full flex justify-between relative border-b-2 border-gray-200 dark:border-white/20 ">
                                <div class="flex flex-col sm:flex-row items-center gap-6">
                                    <!-- IMG AND COUNT BTN -->
                                    <div class="flex w-fit flex-col">
                                        <img src="{{asset('assets/images/products/8.webp')}}" class="w-36"
                                             alt="">
                                        <div
                                            class="cursor-pointer flex items-center justify-between gap-x-1 rounded-lg border border-gray-200 dark:border-white/20 py-1 px-2">
                                            <svg
                                                class="plus-button w-4 h-4 increment text-green-600"
                                            >
                                                <use href="#plus"></use>
                                            </svg>
                                            <input
                                                type="number"
                                                name="cart_items[{{$cartItem['product_id']}}][qty]"
                                                data-cart-product-id="{{$cartItem['product_id']}}"
                                                min="1"
                                                max="50"
                                                value="{{$cartItem['qty']}}"
                                                class="qty-input custom-input mr-8 text-lg bg-transparent"
                                            />
                                            <input type="hidden" name="cart_items[{{$cartItem['product_id']}}][product_id]" value="{{$cartItem['product_id']}}">
                                            <svg
                                                class="minus-button w-4 h-4 decrement text-red-500"
                                            >
                                                <use href="#minus"></use>
                                            </svg>
                                        </div>
                                    </div>
                                    <!-- information and name product -->
                                    <div class="flex flex-col gap-y-4">
                                        <h2 class="font-DanaMedium line-clamp-1">
                                            {{$cartItem['product']->name}}
                                            |
                                            {{$cartItem['product']->name_en}}
                                        </h2>
                                        <div
                                            class="flex items-center gap-x-1 text-gray-700 dark:text-gray-300 font-DanaMedium mt-4">
                                            @if($cartItem['product']->discount)
                                                <div class="product-card_price">
                                                    <del>
                                                        <div
                                                            id="price-{{$cartItem['product_id']}}"
                                                            data-price="{{$cartItem['product']->price}}"
                                                            data-qty="{{$cartItem['qty']}}"
                                                            data-has-discount="true"
                                                            data-base-discount="{{$cartItem['product']->discount}}"
                                                        >
                                                            {{number_format($cartItem['product']->price * $cartItem['qty'])}}
                                                        </div>
                                                        <h6>تومان</h6>
                                                    </del>
                                                    <p
                                                        id="final-price-{{$cartItem['product_id']}}"
                                                    >
                                                        {{number_format(
                                                            ($cartItem['product']->price - $cartItem['product']->discount)
                                                             * $cartItem['qty'])}}
                                                    </p>
                                                    <span>تومان</span>
                                                </div>
                                            @else
                                                <div class="product-card_price">
                                                    <div
                                                        id="price-{{$cartItem['product_id']}}"
                                                        data-price="{{$cartItem['product']->price}}"
                                                        data-qty="{{$cartItem['qty']}}"
                                                        data-has-discount="false"
                                                        data-base-discount="0"
                                                    >
                                                        {{number_format($cartItem['product']->price * $cartItem['qty'])}}
                                                    </div>
                                                    <span>تومان</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="hidden sm:flex items-end justify-between flex-col">
                                    <a href="{{route('cart.remove-item', $cartItem['product_id'])}}">
                                        <svg class="w-5 h-5 cursor-pointer">
                                            <use href="#x-mark"></use>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        @empty
                            <section class="w-full flex flex-col items-center justify-center md:my-2">
                                <img class="float-animation max-w-sm object-cover h-80" src="{{asset('assets/images/svg/empty-cart.svg')}}" alt="404">
                                <div class="flex flex-col justify-center items-center gap-y-2">
                                    <h2 class="font-DanaMedium text-xl">سبد خرید شما خالی است!</h2>
                                    <a href="{{route('products.index')}}" class="flex items-center gap-x-1  text-blue-400 hover:text-blue-500 transition-all">
                                        بازگشت به فروشگاه
                                        <svg class=" size-4 rotate-90">
                                            <use href="#chevron"/>
                                        </svg>
                                    </a>
                                </div>
                            </section>
                        @endforelse


                    </div>
                    @if(getUserCartCount() > 0)
                    <button type="submit"
                            class="w-full mt-4 flex items-center gap-x-1 justify-center bg-blue-500 text-white hover:bg-blue-600 transition-all rounded-lg shadow py-2"
                    >
                        <svg class="w-5 h-5">
                            <use href="#shopping-bag"></use>
                        </svg>
                        بروزرسانی تعداد محصولات
                    </button>
                    @endif
                </form>
            </div>

            <!-- PRICE BOX -->
            <div class="w-full lg:w-1/4 lg:sticky top-5 flex flex-col gap-y-4">
                <!-- PRICE -->
                <ul class="child:flex child:items-center child:justify-between space-y-8">
                    <li>
                        <p>
                            قیمت کالاها
                        </p>
                        <p class="flex gap-x-1 text-gray-600 dark:text-gray-300 ">
                            {{number_format($userCartTotalPrices['final_price'])}}
                            <span class="hidden xl:flex">تومان</span>
                        </p>
                    </li>
                    <li>
                        <p>تخفیف </p>
                        <p class="font-DanaMedium text-gray-700 dark:text-gray-200">
                            {{number_format($userCartTotalPrices['final_discount'])}}
                            تومان
                        </p>
                    </li>
                    <li class="border-t-2 border-dashed border-gray-400 pt-8">
                        <p>مبلغ نهایی :</p>
                        <p>
                            {{number_format($userCartTotalPrices['final_price'] - $userCartTotalPrices['final_discount'])}}
                            تومان
                        </p>
                    </li>
                </ul>

                <a href="{{route('checkout.index')}}"
                   class="w-full mt-4 flex items-center gap-x-1 justify-center bg-blue-500 text-white hover:bg-blue-600 transition-all rounded-lg shadow py-2"
                >
                    <svg class="w-5 h-5">
                        <use href="#shopping-bag"></use>
                    </svg>
                    تایید و تکمیل سفارش
                </a>

            </div>
        </section>

    </main>
@endsection

@push('js')
    <script>

        $(document).on('click', '.increment', function () {

            let input = $(this).siblings('.qty-input');

            let max = parseInt(input.attr('max'));

            let current = parseInt(input.val());

            if (current < max) {

                input.val(current + 1).trigger('change');

            }

        });


        $(document).on('click', '.decrement', function () {

            let input = $(this).siblings('.qty-input');

            let min = parseInt(input.attr('min'));

            let current = parseInt(input.val());

            if (current > min) {

                input.val(current - 1).trigger('change');

            }

        });


        $(document).on('change', '.qty-input', function () {

            let qty = parseInt($(this).val());

            let productId = $(this).data('cart-product-id');

            let priceElement = $('#price-' + productId);

            let unitPrice = parseInt(priceElement.data('price'));

            let discount = parseInt(priceElement.data('base-discount'));

            let hasDiscount = priceElement.data('has-discount');


            let totalPrice = unitPrice * qty;

            priceElement.text(totalPrice.toLocaleString());


            if (hasDiscount) {

                let finalPrice = (unitPrice - discount) * qty;

                $('#final-price-' + productId)
                    .text(finalPrice.toLocaleString());

            }

        });

    </script>
@endpush
