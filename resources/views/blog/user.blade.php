@extends('layout.master')
@section('title', $title)
@section('content')
<div>
    <p class="body_title">自我介紹</p>
</div>
<div class="body_show_region form_radius">
    <div class="">
        <div class="col-sm-3">
            <span class='body_form_title' >姓名：{{ $userData->name }}</span>
        </div>
        <div class="col-sm-3">
            <span class='body_form_title' >性別：
                <?php
                $sex= $userData->sex;
                switch ($sex) {
                    case 0: echo "私密";break;
                    case 1: echo "男";break;
                    case 2: echo "女";break;
                }
                ?>
            </span>
        </div>
    </div>
    <div class="div_clear"></div>
    <div class="body_form_row">
        <div class="col-sm-2">
            <span class='body_form_title' >圖片：</span>
        </div>
        <div class="col-sm-10">
            <img class="body_img"
            @if($userData->picture == "")
                src="/images/nopic.png"
            @else
                src="/{{ $userData->picture }}"
            @endif
            />
        </div>
    </div>
    <div class="div_clear"></div>
    <div class="body_form_row">
        <div class="col-sm-2">
            <span class='body_form_title'>興趣：</span>
        </div>
        <div class="col-sm-10">
            <span class='body_form_title'>{{ $userData->interest }}</span>
        </div>
    </div>
    <div class="div_clear"></div>
    <div class="body_form_row">
        <div class="col-sm-2">
            <span class='body_form_title'>自我介紹：</span>
        </div>
        <div class="col-sm-10">
            <span class='body_form_title'>{{ $userData->introduce }}</span>
        </div>
    </div>
</div>
@endsection
