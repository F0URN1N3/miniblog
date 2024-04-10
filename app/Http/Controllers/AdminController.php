<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShareData;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class AdminController extends Controller
{
    public $page = "admin";

    //自我介紹頁面
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
            if(file_exists(public_path($old_picture))){
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

        // if(isset($input['file'])){
        //     $img= $input['file'];
        //     $extension_name= $img->getClientOriginalExtension();
        //     $file_name= uniqid().'.'.$extension_name;
        //     $relative_path= 'images\\user\\'.$file_name;
        //     $full_path= public_path($relative_path);
        //     $image= Image::make($img)->resize(300,300)->save($full_path);
        //     $User->picture= $relative_path;
        // }
        $User->name = $input['name'];
        $User->sex = $input['sex'];
        $User->interest = $input['interest'];
        $User->introduce = $input['introduce'];
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

}
