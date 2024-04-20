<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShareData;
use App\Models\User;
use App\Models\Newsfeed;

class HomeController extends Controller
{
    public $page = "";
    //首頁
    public function indexPage(){
        $name= 'home';

        $user_list= User::all();

        $binding=[
            'title'=> ShareData::TITLE,
            'name'=> $name,
            'page' => $this->page,
            'User' => $this->GetUserData(),
            'user_list' => $user_list,
        ];
        return view('home', $binding);
    }

    //個人主頁
    public function userPage($user_id){
        $this->page= 'user';
        $name= 'user';
        $userData= User::where('id', $user_id)->first();

        if(!$userData){
            return redirect('/');
        }

        $binding= [
            'title' => ShareData::TITLE,
            'page' => $this->page,
            'name' => $name,
            'User' => $userData,
            'userData' => $userData,
        ];

        return view('blog.user', $binding);
    }

    //心情隨筆
    public function newsfeedPage($user_id)
    {
        $this->page = 'user';
        $name = 'newsfeed';

        $userData = User::where('id', $user_id)->first();

        if(!$userData)
            return redirect('/');

        $newsfeedList = Newsfeed::where('u_id', $user_id)->orderby('created_at', 'desc')->get();

        $binding = [
            'title' => ShareData::TITLE,
            'page' => $this->page,
            'name' => $name,
            'User' => $this->GetUserData(),
            'userData' => $userData,
            'newsfeedList' => $newsfeedList,
        ];
        return view('blog.newsfeed', $binding);
    }

}
