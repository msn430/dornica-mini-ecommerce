@extends('account.layouts.app')

@section('account-content')
    <div class="flex flex-col shadow rounded-lg p-4 dark:bg-gray-800 bg-white mt-5 lg:mt-0">
        <div class="flex items-center justify-between">
            <h2 class="font-DanaMedium text-lg">اطلاعات حساب کاربری</h2>
        </div>
        <form class="mt-5 grid grid-cols-12 gap-5 child:col-span-12 child:lg:col-span-6"
              action=""
              method="POST"
        >
            @csrf
            <!-- ITEM -->
            <div>
                <label for="first_name" class="block text-sm font-DanaMedium text-gray-500 dark:text-gray-300">
                    نام
                </label>
                <div class="mt-3 relative">
                    <input
                        id="first_name"
                        type="text"
                        class="block w-full p-2.5 text-base outline dark:outline-none outline-1 -outline-offset-1 placeholder:text-gray-400 transition-all text-gray-800 dark:text-gray-100 dark:bg-gray-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded-md outline-none focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 dark:focus:ring-blue-400"
                        name="first_name"
                        value="{{ old('first_name' , $user->first_name) }}"
                    >
                </div>
            </div>
            @error('first_name')
            <span style="color: red">{{ $message }}</span>
            @enderror
            <!-- ITEM -->
            <div>
                <label for="last_name" class="block text-sm font-DanaMedium text-gray-500 dark:text-gray-300">
                    نام خانوادگی
                </label>
                <div class="mt-3 relative">
                    <input
                        id="last_name"
                        type="text"
                        class="block w-full p-2.5 text-base outline dark:outline-none outline-1 -outline-offset-1 placeholder:text-gray-400 transition-all text-gray-800 dark:text-gray-100 dark:bg-gray-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded-md outline-none focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 dark:focus:ring-blue-400"
                        name="last_name"
                        value="{{ old('last_name' , $user->last_name) }}"
                    >
                </div>
            </div>
            @error('last_name')
            <span style="color: red">{{ $message }}</span>
            @enderror
            <!-- ITEM -->
            <div>
                <label for="mobile" class="block text-sm font-DanaMedium text-gray-500 dark:text-gray-300">
                    شماره موبایل
                </label>
                <div class="mt-3 relative">
                    <input
                        id="mobile"
                        type="text"
                        class="block w-full p-2.5 text-base outline dark:outline-none outline-1 -outline-offset-1 placeholder:text-gray-400 transition-all text-gray-800 dark:text-gray-100 dark:bg-gray-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded-md outline-none focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 dark:focus:ring-blue-400"
                        name="mobile"
                        value="{{ old('mobile', $user->mobile) }}"
                    >
                </div>
            </div>
            @error('mobile')
            <span style="color: red">{{ $message }}</span>
            @enderror
            <!-- ITEM -->
            <div>
                <label for="email" class="block text-sm font-DanaMedium text-gray-500 dark:text-gray-300">
                    ایمیل
                </label>
                <div class="mt-3 relative">
                    <input
                        id="email"
                        type="text"
                        class="block w-full p-2.5 text-base outline dark:outline-none outline-1 -outline-offset-1 placeholder:text-gray-400 transition-all text-gray-800 dark:text-gray-100 dark:bg-gray-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded-md outline-none focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 dark:focus:ring-blue-400"
                        name="email"
                        value="{{ old('email', $user->email) }}"
                    >
                </div>
            </div>
            @error('email')
            <span style="color: red">{{ $message }}</span>
            @enderror
            <!-- ITEM -->
            <div>
                <label for="password" class="block text-sm font-DanaMedium text-gray-500 dark:text-gray-300">
                    رمز عبور
                </label>
                <div class="mt-3 relative">
                    <input
                        id="password"
                        type="password"
                        class="block w-full p-2.5 text-base outline dark:outline-none outline-1 -outline-offset-1 placeholder:text-gray-400 transition-all text-gray-800 dark:text-gray-100 dark:bg-gray-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded-md outline-none focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 dark:focus:ring-blue-400"
                        name="password"
                        value="{{ old('password') }}"
                    >
                </div>
            </div>
            @error('password')
            <span style="color: red">{{ $message }}</span>
            @enderror
            <div class="mt-6">
                <button type="submit" class="submit-btn h-10 mt-2">ثبت ویرایش</button>
            </div>
            @if(session('success'))
                <p class="justify-center">
                    {{ session('success') }}
                </p>
            @endif
        </form>
    </div>
@endsection
