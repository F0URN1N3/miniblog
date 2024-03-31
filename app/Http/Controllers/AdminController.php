<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShareData;

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
            'result' => '',
        ];
        return view('admin.edituser', $binding);
    }
}
