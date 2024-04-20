<!-- 指定繼承 layout.master 母模板 -->
@extends('layout.master')

<!-- 傳送資料到母模板，並指定變數為title -->
@section('title', $title)

<!-- 傳送資料到母模板，並指定變數為content -->
@section('content')

<div class="main_region">
    @foreach ($user_list as $each_user)
        <div class="col-10">
            <img class="circle_img" alt="{{$each_user->name}}" title="{{$each_user->name}}" onclick="Visit({{$each_user->id}})"
            @if($each_user->picture == "")
                src="/images/nopic.png"
            @else
                src="/{{ $each_user->picture }}"
            @endif
            />
        </div>
    @endforeach
</div>

<script>
    function Visit(id){
        location.href= "/" + id + "/user" ;
    }
</script>

@endsection
