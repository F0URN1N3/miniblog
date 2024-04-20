<!-- 指定繼承 layout.master 母模板 -->
@extends('layout.master')

<!-- 傳送資料到母模板，並指定變數為title -->
@section('title', $title)

<!-- 傳送資料到母模板，並指定變數為content -->
@section('content')
<div>
    <p class="body_title">心情隨筆</p>
</div>
<div class="body_show_region form_radius">
    @foreach($newsfeedList as $each_newsfeed)
    <div>時間: {{ $each_newsfeed->created_at }}</div>
    <div class="body_content">{{ $each_newsfeed->content }}</div>
    @endforeach
</div>
@endsection
