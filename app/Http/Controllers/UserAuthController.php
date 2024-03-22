<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShareData;

class UserAuthController extends Controller
{
    //使用者註冊
    public function signUpPage(){
        $name= 'sign_up';
        $binding= [
            'title'=> ShareData::TITLE,
            'name'=> $name,
        ];
        return view('user.sign-up', $binding);
    }

}
