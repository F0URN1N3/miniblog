<!-- 指定繼承 layout.master 母模板 -->
@extends('layout.master')

<!-- 傳送資料到母模板，並指定變數為title -->
@section('title', $title)

<!-- 傳送資料到母模板，並指定變數為content -->
@section('content')
<!-- 自動產生 csrf_token 隱藏欄位-->
{!! csrf_field() !!}
<div class="normal_form">
    <div class="form_title">心情隨筆列表</div>
    <div class="btn_group">
        <button type="button" class="btn btn-primary btn_form" onclick="AddData()">新增</button>
    </div>
    <div class="table-responsive">
        <table class="table table-hover form_label">
            <thead>
                <tr>
                    <th>日期</th>
                    <th>內容</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($listPaginate as $data)
                <tr>
                    <td>{{ $data->created_at }}</td>
                    <td>{{ $data->content }}</td>
                    <td class="right">
                    <button type="button" class="btn btn-success btn_form" onclick="EditData({{ $data->id }})">修改</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
{{ $listPaginate}}
<script>
    //新增心情隨筆
    function AddData()
    {
        location.href = "/admin/newsfeed/add";
    }
    //編輯心情隨筆
    function EditData($id)
    {
        location.href = "/admin/newsfeed/" + $id + "/edit";
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
