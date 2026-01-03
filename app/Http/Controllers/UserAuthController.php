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
    public $page = "";
//使用者註冊頁面
    public function signUpPage(){
        $name= 'sign_up';
        $binding= [
            'title'=> ShareData::TITLE,
            'name'=> $name,
            'page' => $this->page,
            'User' => $this->GetUserData(),
        ];
        return view('user.sign-up', $binding);
    }

//使用者註冊程式
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
        //啟用紀錄SQL語法
        DB::enableQueryLog();
        //insert資料
        User::create($input);
        //在log中列印Eloquent SQL語法
        Log::notice(print_r(DB::getQueryLog(), true));
        //申請成功就直接登入
        $User = User::where('email', $input['email'])->first();
        //session紀錄會員編號
        session()->put('user_id', $User->id);

        return redirect('admin/user/')->with('signUpResult','success');

        exit;
    }

//使用者登入畫面
    public function signInPage(){
        $name = 'sign_in';
        $binding = [
            'title' => ShareData::TITLE,
            'name' => $name,
            'page' => $this->page,
            'User' => $this->GetUserData(),
        ];
        return view('user.sign-in', $binding);
    }

//使用者登入程式
    public function signInProcess(Request $request){
        //接收輸入資料
        $input = request()->all();

        //驗證規則
        $rules = [
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
        ];

        //驗證資料
        $validator = Validator::make($input, $rules);

        if($validator->fails()){
            //資料驗證錯誤
            return redirect('/user/auth/sign-in')
                ->withErrors($validator)
                ->withInput();
        }

        //取得使用者資料
        $User = User::where('email', $input['email'])->first();

        if(!$User){
            //帳號錯誤回傳錯誤訊息
            $error_message = [
                'msg' => [
                    '帳號輸入錯誤',
                ],
            ];

            return redirect('/user/auth/sign-in')
                ->withErrors($error_message)
                ->withInput();
        }

        //檢查密碼是否正確
        $is_password_correct = Hash::check($input['password'], $User->password);

        if(!$is_password_correct){
            //密碼錯誤回傳錯誤訊息
            $error_message = [
                'msg' => [
                    '密碼輸入錯誤',
                ],
            ];

            return redirect('/user/auth/sign-in')
                ->withErrors($error_message)
                ->withInput();
        }

        //session紀錄會員編號
        session()->put('user_id', $User->id);

        //重新導向到原先使用者造訪頁面，沒有嘗試造訪頁則重新導向回自我介紹頁
        // 如果登入成功，檢查是否有重定向參數
        if($request->has('redirect')){
            // 如果有重定向參數，將用戶重定向到該頁面
            return redirect($request->input('redirect'));
        }else{
            // 否則，將用戶重定向到默認頁面
            return redirect('/');
        }

        exit;
    }

    //登出
    public function signOut(){
        //清除Session
        session()->forget('user_id');

        //重新導向回首頁
        return redirect('/');
    }

}
