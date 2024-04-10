<!-- 指定繼承 layout.master 母模板 -->
@extends('layout.master')
<!-- 傳送資料到母模板，並指定變數為title -->
@section('title', $title)
<!-- 傳送資料到母模板，並指定變數為content -->
@section('content')

<form id="form1" method="post" action="" enctype="multipart/form-data">
<!-- 自動產生 csrf_token 隱藏欄位-->
{{ csrf_field() }}
<div class="normal_form">
    <div class="row">
        <div class="form_title">自我介紹</div>
        <div class="col-sm-6">
            <div class="form_label">帳號</div>
            <div class="form_textbox_region">
                <input name="email" class="form_textbox" type="text" value="{{ $User->email }}" readonly="true" placeholder="請輸入帳號"/>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form_label">暱稱</div>
            <div class="form_textbox_region">
                <input name="name" class="form_textbox" type="text" value="{{ $User->name }}" />
            </div>
        </div>
        <div class="div_clear"></div>
        <div class="col-sm-2">
            <div class="form_label">性別</div>
            <div class="form_textbox_region">
                <select class="form_select" id="sex" name="sex" placeholder="請選擇性別">
                    <option value="0"
                    @if($User->sex == 0)
                        selected
                    @endif
                    >未公開</option>
                    <option value="1"
                    @if($User->sex == 1)
                        selected
                    @endif
                    >男性</option>
                    <option value="2"
                    @if($User->sex == 2)
                        selected
                    @endif
                    >女性</option>
                </select>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form_label">興趣</div>
            <div class="form_textbox_region">
                <input name="interest" class="form_textbox" type="text" value="{{ $User->interest }}" placeholder="請輸入興趣"/>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form_label">
                圖片　
                <input type="file" name="file" id="file" class="inputfile" onchange="loadFile(event)" />
                <label for="file">上傳圖片</label>
            </div>
            <div class="form_textbox_region">
                <img id="file_review" class="upload_img"
                @if($User->picture == "")
                    src="/images/nopic.png"
                @else
                    src="/{{$User->picture}}"
                @endif
                />
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form_label">自我介紹</div>
            <div class="form_textbox_region">
                <textarea name="introduce" class="form_textarea" placeholder="請輸入自我介紹">{{ $User->introduce }}</textarea>
            </div>
        </div>
        <div class="div_clear"/>
        <div class="form_error">
            <!-- 錯誤訊息模板元件 -->
            @include('layout.ValidatorError')
        </div>
        <div class="btn_group">
            <button type="submit" class="btn btn-primary btn_form">儲存</button>
        </div>
    </div>
<div>
</form>

<script>
//預覽圖片

var loadFile = function(event) {
    var output = document.getElementById('file_review');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
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
