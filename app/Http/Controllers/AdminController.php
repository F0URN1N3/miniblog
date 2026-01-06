<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\Newsfeed;
use Illuminate\Http\Request;
use App\Models\ShareData;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class AdminController extends Controller
{
    public $page = "admin";

//個人資料頁面
    public function editUserPage(){
        $User = $this->GetUserData();
        if(!$User){
            //如果找不到使用者，就回到首頁
            return redirect('/');
        }
        $name = 'user';

        $binding = [
            'title' => ShareData::TITLE,
            'page' => $this->page,
            'name' => $name,
            'User' => $User,
        ];
        return view('admin.edituser', $binding);
    }

//編輯個人資料
    public function editUserProcess(Request $request){
        $User= $this-> GetUserData();
        if(!$User){
            return redirect('/');
        }

        $name= 'user';
        $input= request()->all();
        $rule= [
            'name'=> [
                'required',
                'min: 2',
            ],
            'sex' => [
                'integer',
            ],
            'interest'=>[
                'max: 300'
            ],
            'introduce'=>[
                'max: 1000'
            ],
            'file'=> 'image|mimes:png,jpg,jpeg|max:20480',
        ];

        $validator= Validator::make($input, $rule);
        if($validator->fails()){
            $User->interest = $input['interest'];
            $User->introduce = $input['introduce'];
            $binding=[
                'title'=> ShareData::TITLE,
                'page'=> $this->page,
                'name'=> $name,
                'User'=> $User,
                'result' => '',
            ];
            return view('admin.edituser', $binding)->withErrors($validator);
        }

        if($request->file('file')){
            //刪除舊照片
            $old_picture= $User->picture;
            if($old_picture!=null && file_exists(public_path($old_picture))){
                unlink(public_path($old_picture));
            }
            //新增大頭貼
            $img_request= $request->file('file');
            $img_manager= new ImageManager(new Driver());
            $extension_name= $img_request->getClientOriginalExtension();
            $file_name= uniqid().'.'.$extension_name;
            $relative_path= 'images/UserPictures/'.$file_name;
            $full_path= public_path($relative_path);
            $img_manager->read($img_request)->resize(300, 300)->save($full_path);
            $User->picture= $relative_path;
        }

        if($input['name']!= null){
            $User->name = $input['name'];
        }
        if($input['sex']!= null){
            $User->sex = $input['sex'];
        }else{
            $User->sex = 0;
        }
        if($input['interest']!= null){
            $User->interest = $input['interest'];
        }else{
            $User->interest = '';
        }
        if($input['introduce']!= null){
            $User->introduce = $input['introduce'];
        }else{
            $User->introduce = '';
        }
        $User->save();
        $binding = [
            'title' => ShareData::TITLE,
            'page' => $this->page,
            'name' => $name,
            'User' => $User,
            'result' => 'success',
        ];
        return view('admin.edituser', $binding)
                ->withErrors($validator);


    }

//一句話列表頁面
    public function newsfeedListPage()
    {
        //先取得自己的資料
        $User = $this->GetUserData();
        //取得一句話列表
        $newsfeedList = Newsfeed::where('u_id', $User->id)->orderBy('created_at', 'desc')->get();
        $name = 'newsfeed';

        //接收輸入資料
        $input = request()->all();

        $result = '';
        if(isset($input['result'])){
            $result = $input['result'];
        }

        $binding = [
            'title' => ShareData::TITLE,
            'page' => $this->page,
            'name' => $name,
            'User' => $User,
            'newsfeedList' => $newsfeedList,
            'result' => $result,
        ];
        return view('admin.newsfeedlist', $binding);
    }

//新增一句話資料頁面
    function addNewsfeedPage()
    {
        //先取得自己的資料
        $User = $this->GetUserData();
        //取得一句話列表
        $newsfeed = new Newsfeed;
        $name = 'newsfeed';
        $action = '新增';

        $binding = [
            'title' => ShareData::TITLE,
            'page' => $this->page,
            'name' => $name,
            'User' => $User,
            'newsfeed' => $newsfeed,
            'action' => $action,
            'result' => '',
        ];
        return view('admin.newsfeed', $binding);
    }

//編輯一句話資料
    function editNewsfeedProcess()
    {
        $User = $this->GetUserData();
        if(!$User){
            return redirect('/');
        }
        $name = 'newsfeed';

        //接收輸入資料
        $input = request()->all();

        //驗證規則
        $rules = [
            //內容
            'content' => [
                'required',
                'max:1000',
            ],
        ];

        //驗證資料
        $validator = Validator::make($input, $rules);

        if($input['id'] == ''){
            //新增
            $action = '新增';
            $newsfeed = new Newsfeed;
            $newsfeed->content = $input['content'];
        }
        else{
            //修改
            $action = '修改';
            //取得一句話列表
            $newsfeed = Newsfeed::where('id', $input['id'])->where('u_id', $User->id)->first();

            if(!$newsfeed){
                //如果找不到資料就回列表頁
                return redirect('/admin/newsfeed');
            }
            $newsfeed->content = $input['content'];
        }

        if($validator->fails()){
            $binding = [
                'title' => ShareData::TITLE,
                'page' => $this->page,
                'name' => $name,
                'User' => $User,
                'newsfeed' => $newsfeed,
                'action' => $action,
                'result' => '',
            ];
            return view('admin.newsfeed', $binding)
                ->withErrors($validator);
        }
        //新增
        if($input['id'] == ''){
            $input["u_id"] = $User->id;
            $input["enable"] = 1;
            Newsfeed::create($input);
        }
        else{
            //修改
            $newsfeed->save();
        }

        //成功就轉回列表頁
        return redirect('/admin/newsfeed/?result=success');
    }

//編輯一句話資料
    function editNewsfeedPage($newsfeed_id)
    {
        //先取得自己的資料
        $User = $this->GetUserData();
        //取得一句話列表
        $newsfeed = Newsfeed::where('id', $newsfeed_id)->where('u_id', $User->id)->first();

        if(!$newsfeed)
        {
            //如果找不到資料就回列表頁
            return redirect('/admin/newsfeed');
        }

        $name = 'newsfeed';
        $action = '修改';

        $binding = [
            'title' => ShareData::TITLE,
            'page' => $this->page,
            'name' => $name,
            'User' => $User,
            'newsfeed' => $newsfeed,
            'action' => $action,
            'result' => '',
        ];
        return view('admin.newsfeed', $binding);
    }

    public function deleteNewsfeedProcess($newsfeed_id)
    {
        $user = $this->GetUserData();
        if (!$user) return redirect('/login');

        // 確保刪除的是自己的貼文
        $newsfeed = Newsfeed::where('id', $newsfeed_id)
                    ->where('u_id', $user->id)
                    ->first();

        if ($newsfeed) {
            $newsfeed->delete();
            return redirect('/admin/newsfeed')->with('success', '刪除成功');
        }

        return redirect('/admin/newsfeed');
    }
}
