<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactUsPostRequest;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactUsController extends Controller
{
    public function index(){

        $title = 'تماس با ما';

        return view('contact_us',compact('title'));
    }
    public function post(ContactUsPostRequest $request){

        $comment = $request->only(['user_id','title','content']);

        $comment['user_id'] = auth()->id();

        ContactUs::create($comment);

        return redirect()->back()->with('success' ,'دیدگاه شما با موفقیت ثبت گردید. پس از بررسی با شما تماس حاصل می گردد');
    }
}
