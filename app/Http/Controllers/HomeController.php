<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShareData;

class HomeController extends Controller
{
    public $page = "";
    //首頁
    public function indexPage(){
        $name= 'home';
        $binding=[
            'title'=> ShareData::TITLE,
            'name'=> $name,
            'page' => $this->page,
            'User' => $this->GetUserData(),
        ];
        return view('home', $binding);
    }

}
