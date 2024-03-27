<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShareData;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
            'email' => [
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
            return redirect('user/auth/sign-up')
                -> withErrors($validator)
                -> withInput();
        }

        //密碼加密
        $input['password']= Hash::make($input['password']);
        //insert資料
        User::create($input);

        //將執行紀錄寫進storage\logs
        DB::enableQueryLog();
        Log::notice(print_r($input));

        return redirect('user/auth/sign-up');

        exit;
    }

}
