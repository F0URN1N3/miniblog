<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShareData;
use Illuminate\Support\Facades\Validator;

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

    public function signUpProcess(){
        //接收輸入資料
        $input = request()-> all();

        //驗證規則
        $rules = [
            //暱稱
            'name' => [
                'required',
                'max:50',
            ],
            //帳號(E-mail)
            'account' => [
                'required',
                'max:50',
                'email',
            ],
            //密碼
            'password' => [
                'required',
                'min:5',
            ],
            //密碼驗證
            'password_confirm' => [
                'required',
                'same:password',
                'min:5'
            ],
        ];

        //驗證資料
        $validator = Validator::make($input, $rules);

        //資料錯誤處理
        if($validator->fails()){
            return redirect('user/auth/sign-up')-> withErrors($validator);
        }

        exit;
    }

}
