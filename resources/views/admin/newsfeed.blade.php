<!-- 指定繼承 layout.master 母模板 -->
@extends('layout.master')

<!-- 傳送資料到母模板，並指定變數為title -->
@section('title', $title)

<!-- 傳送資料到母模板，並指定變數為content -->
@section('content')
<form method="post" action="/admin/newsfeed/edit">
<!-- 自動產生 csrf_token 隱藏欄位-->
{!! csrf_field() !!}
<input name="id" type="hidden" value="{{ $newsfeed->id }}"/>
<div class="normal_form">
    <div class="form_title">{{ $action }}一句話</div>
    <div class="form-group">
        <div class="d-flex justify-content-between align-items-end mb-2">
            <label for="exampleFormControlTextarea1" class="m-0">一句話內容</label>
            @if($action == "修改")
                <a href="/admin/newsfeed/{{ $newsfeed->id }}/delete/"
                class="text-danger"
                style="text-decoration: none; font-size: 0.9rem;"
                onclick="return confirm('確定要刪除這則貼文嗎？')">
                <i class="fa fa-trash"></i> 刪除此篇
                </a>
            @endif
        </div>
        <textarea class="form-control" name="content" rows="3">{{ $newsfeed->content }}</textarea>
    </div>

    <div class="btn_group">
        <button type="button" class="btn btn-warning btn_form" onclick="Cancel()">取消</button>
        <button type="summit" class="btn btn-primary btn_form">{{ $action }}</button>
    </div>
    <div class="form_error">
        <!-- 錯誤訊息模板元件 -->
        @include('layout.ValidatorError')
    </div>
<div>
</form>

<script>
function Cancel()
{
    location.href = "/admin/newsfeed";
}
</script>
@endsection
