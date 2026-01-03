<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShareData;
use App\Models\User;
use App\Models\Newsfeed;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public $page = "";
    //首頁
    public function indexPage(){
        $name= 'home';
        //DB::enableQueryLog();

        //取得用戶主頁連結
        $user_list=
        User::query()
        ->select('users.*')
        ->join('newsfeeds', function ($join) {
            $join->on('users.id', '=', 'newsfeeds.u_id')
                ->whereRaw('newsfeeds.created_at = (SELECT MAX(created_at) FROM newsfeeds WHERE u_id = users.id)');
        })
        ->orderBy('newsfeeds.created_at', 'desc')
        ->get();

        $newsfeedList=
        Newsfeed::query()
        ->select('newsfeeds.*', 'users.name', 'users.picture')
        ->join('users', 'users.id', '=', 'newsfeeds.u_id')
        ->orderBy('created_at', 'desc')
        ->get()
        ;


        //print_r(DB::getQueryLog());

        $binding=[
            'title'=> ShareData::TITLE,
            'name'=> $name,
            'page' => $this->page,
            'User' => $this->GetUserData(),
            'user_list' => $user_list,
            'newsfeedList' => $newsfeedList,
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
            'User' => $this->GetUserData(),
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

        if(!$userData){
            return redirect('/');
        }

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
