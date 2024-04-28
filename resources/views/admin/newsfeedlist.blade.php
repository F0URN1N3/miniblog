<!-- 指定繼承 layout.master 母模板 -->
@extends('layout.master')

<!-- 傳送資料到母模板，並指定變數為title -->
@section('title', $title)

<!-- 傳送資料到母模板，並指定變數為content -->
@section('content')
<!-- 自動產生 csrf_token 隱藏欄位-->
{!! csrf_field() !!}
<div class="normal_form">
    <div class="form_title">備忘錄列表</div>
    <div class="btn_group">
        <button type="button" class="btn btn-primary btn_form" onclick="AddData()">新增</button>
    </div>
    <div class="body_show_region form_radius">
        @foreach($newsfeedList as $each_newsfeed)
        <div class="margin_eachNewsfeed">
            <span>時間: {{ $each_newsfeed->created_at }} 說：</span>
            @if(isset($User) && $User->id == $each_newsfeed->u_id)
            <span style="float:right;"><a href="/admin/newsfeed/{{ $each_newsfeed->id }}/edit">編輯備忘錄</a></span>
            @endif
        </div>
        <div class="body_content">{{ $each_newsfeed->content }}</div>
        <div class="nwsfd_goComment"><a href="/{{ $each_newsfeed->id }}/comment/">查看回應</a></div>

        @endforeach
    </div>
<script>
    //新增備忘錄
    function AddData()
    {
        location.href = "/admin/newsfeed/add";
    }
</script>

<script type="module">
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
