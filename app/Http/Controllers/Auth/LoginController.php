<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginPostRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        $withoutFooter = true;
        $withoutHeader = true;

        $title = 'ورود';

        return view('auth.login', compact('withoutFooter', 'withoutHeader', 'title'));
    }

    public function post(LoginPostRequest $request)
    {
        $user = User::query()
            ->whereMobile($request->input('mobile'))
            ->first();
        if (!Hash::check($request->input('password'), $user->password)) {

            return back()->withErrors([
                'pass_invalid' => 'رمزعبور صحیح نمی باشد',
            ])->withInput([
                'mobile' => "$request->mobile"]);

        }
        Auth::login($user);

        return redirect()->route('index');

    }
}
