<!-- 指定繼承 layout.master 母模板 -->
@extends('layout.master')
<!-- 傳送資料到母模板，並指定變數為title -->
@section('title', $title)
<!-- 傳送資料到母模板，並指定變數為content -->
@section('content')

<form id="form1" method="post" action="">
{{ csrf_field() }}
<div class="login_form">
    <div class="login_title">登入</div>
    <div class="login_label">帳號(必須為E-mail)</div>
    <div class="login_textbox">
        <input name="email" class="form_textbox" type="text" value="{{ old('account') }}" placeholder="請輸入帳號"/>
    </div>
    <div class="login_label">密碼</div>
    <div class="login_textbox">
        <input name="password" class="form_textbox" type="password" value="{{ old('password') }}" placeholder="請輸入密碼"/>
    </div>
    <div class="login_error">
        {{-- 錯誤訊息顯示處 --}}
        @include('layout.ValidatorError')
    </div>
    <div class="btn_group">
        <button type="button" class="btn btn-warning btn_login" onclick="SignUp()">註冊</button>
        <button type="submit" class="btn btn-success btn_login">登入</button>
    </div>
</div>
</form>

<script>
    function SignUp(){
        location.href="/user/auth/sign-up";
    }

    var iaoMsg= '';
    <?PHP
    if(isset($result)){
        if($result == "success"){
            echo('var iaoMsg= "修改資料成功!";');
        }else{
            echo('var iaoMsg= "";');
        }
    }
    ?>
    if(iaoMsg=="修改資料成功!"){
        $.iaoAlert({
            type: "success",
            mode: "dark",
            msg: iaoMsg,
            position:'bottom-right',
            roundedCorner:true,
        })
    }
</script>
@endsection
