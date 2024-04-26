<!-- 指定繼承 layout.master 母模板 -->
@extends('layout.master')

<!-- 傳送資料到母模板，並指定變數為title -->
@section('title', $title)

<!-- 傳送資料到母模板，並指定變數為content -->
@section('content')

<div class="scrollmenu">
    @foreach ($user_list as $each_user)
            <img class="circle_img" alt="{{$each_user->name}}" title="{{$each_user->name}}" onclick="Visit({{$each_user->id}})"
            @if($each_user->picture == "")
                src="/images/nopic.png"
            @else
                src="/{{ $each_user->picture }}"
            @endif
            />
    @endforeach
</div>

<div class="body_show_region form_radius">
    @foreach($newsfeedList as $each_newsfeed)
    <div class="margin_eachNewsfeed">
        <span class="nwsfd_u_name">{{ $each_newsfeed->name }}</span>
        <span>{{ $each_newsfeed->created_at }} 說：</span>
            @if(isset($User) && $User->id == $each_newsfeed->u_id)
            <span style="float:right;"><a href="/admin/newsfeed/{{ $each_newsfeed->id }}/edit">編輯說法</a></span>
            @endif
    </div>
    <div class="body_content">{{ $each_newsfeed->content }}</div>
    <div class="nwsfd_goComment"><a href="/{{ $each_newsfeed->id }}/comment/">查看回應</a></div>

    @endforeach
</div>
<script>
    function Visit(id){
        location.href= "/" + id + "/user" ;
    }
</script>

@endsection

