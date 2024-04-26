<!-- 指定繼承 layout.master 母模板 -->
@extends('layout.master')

<!-- 傳送資料到母模板，並指定變數為title -->
@section('title', $title)

<!-- 傳送資料到母模板，並指定變數為content -->
@section('content')
<div>
    <p class="body_title">{{ $userData->name }}的隨口說說</p>
</div>
<div class="body_show_region form_radius">
    @foreach($newsfeedList as $each_newsfeed)
    <div class="margin_eachNewsfeed">
        <span>時間: {{ $each_newsfeed->created_at }} 說：</span>
        @if(isset($User) && $User->id == $each_newsfeed->u_id)
        <span style="float:right;"><a href="/admin/newsfeed/{{ $each_newsfeed->id }}/edit">編輯說法</a></span>
        @endif
    </div>
    <div class="body_content">{{ $each_newsfeed->content }}</div>
    <div class="nwsfd_goComment"><a href="/{{ $each_newsfeed->id }}/comment/">查看回應</a></div>

    @endforeach
</div>
@endsection
