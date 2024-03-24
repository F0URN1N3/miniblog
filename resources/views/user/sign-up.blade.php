@extends('layout.master')

@section('title', $title)

@section('content')
<form id="form1" method="POST" action="">
{{ csrf_field() }}
<div class="login_form">
    <div class="login_title">註冊</div>
    <div class="login_label">暱稱</div>
    <div class="login_textbox">
        <input name="name" class="form_textbox" type="text" placeholder="請輸入暱稱"/>
    </div>
    <div class="login_label">帳號(必須為E-mail)</div>
    <div class="login_textbox">
        <input name="account" class="form_textbox" type="text" placeholder="請輸入帳號"/>
    </div>
    <div class="login_label">密碼</div>
    <div class="login_textbox">
        <input name="password" class="form_textbox" type="password" placeholder="請輸入密碼"/>
    </div>
    <div class="login_label">密碼確認</div>
    <div class="login_textbox">
        <input name="password_confirm" class="form_textbox" type="password" placeholder="請確認密碼"/>
    </div>
    <div class="login_error">
        {{-- 錯誤訊息顯示處 --}}
        @include('layout.ValidatorError')
    </div>
    <div class="btn_group">
        <button type="submit" class="btn btn-primary btn_login">註冊</button>
    </div>
</div>
</form>
@endsection
