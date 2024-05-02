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
        <div class="nwsfd_goComment" data-id="{{ $each_newsfeed->id }}">
            <button class="load-comments">查看回應</button>
            <div class="comments" style="display:none;"></div>
            <form class="comment-form" style="display:none;">
                @csrf
                <input id="input-comment" type="text" name="content" >
                <button type="submit">新增回應</button>
            </form>
        </div>
        @endforeach
    </div>
<script>
    //新增備忘錄
    function AddData()
    {
        location.href = "/admin/newsfeed/add";
    }

    $(document).ready(function() {
        // 加載 comment
        $('.load-comments').click(function() {
            var newsfeedId = $(this).closest('.nwsfd_goComment').data('id');
            var commentsDiv = $(this).siblings('.comments');
            var commentform = $(this).siblings('.comment-form');
            var loadComments = $(this).closest('.load-comments');
            $.ajax({
                url: '/newsfeed/' + newsfeedId + '/comments',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    // console.log(response.comments);
                    var reaponse_str= response.comments[0];
                    commentsDiv.html('');

                    if(reaponse_str==null){
                        commentsDiv.append('<div class="each_comment" style="text-align:center; color:gray;"><span>目前沒有回應</span>');
                    }
                    $.each(response.comments, function(index, value){
                        var isoDateStr = value.updated_at;
                        var strDate = moment(isoDateStr).format('YYYY/MM/DD, hh:mm:ss');
                        commentsDiv.append(
                            '<div class="each_comment"><span class="nwsfd_u_name">' + value.name + '：</span>'+
                            '<span>' + value.content + '</span>'+
                            '<span class="comment_date">' + strDate + '</span></div>'
                        );
                    });
                    commentsDiv.show();
                    commentform.show();
                    loadComments.hide();
                }
            });
        });

        // 提交 comment
        $('.comment-form').submit(function(event) {
            event.preventDefault();
            var newsfeedId = $(this).closest('.nwsfd_goComment').data('id');
            var formData = $(this).serialize();
            $.ajax({
                url: '/newsfeed/' + newsfeedId + '/comments',
                type: 'POST',
                data: formData,
                success: function(response) {
                    loadComments(newsfeedId);
                }
            });
        });

        //重新加載 comments
        function loadComments(newsfeedId) {
            var commentsDiv = $('.nwsfd_goComment[data-id="' + newsfeedId + '"]').find('.comments');
            var commentform = $(this).siblings('.comment-form');
            $.ajax({
                url: '/newsfeed/' + newsfeedId + '/comments',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    var reaponse_str= response.comments[0];
                    commentsDiv.html('');

                    if(reaponse_str==null){
                        commentsDiv.append('<div class="each_comment" style="text-align:center; color:gray;"><span>目前沒有回應</span>');
                    }
                    $.each(response.comments, function(index, value){
                        var isoDateStr = value.updated_at;
                        var strDate = moment(isoDateStr).format('YYYY/MM/DD, hh:mm:ss');
                        commentsDiv.append('<div class="each_comment"><span class="nwsfd_u_name">' + value.name + '：</span><span>' + value.content + '</span><span class="comment_date">' + strDate + '</span></div>');
                    });
                    commentsDiv.show();
                    commentform.show();
                    $('input[name=content]').val('');
                }
            });
        }
    });

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
