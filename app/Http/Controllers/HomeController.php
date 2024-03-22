<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShareData;

class HomeController extends Controller
{
    //首頁
    public function indexPage(){
        $name= 'home';
        $binding=[
            'title'=> ShareData::TITLE,
            'name'=> $name,
        ];
        return view('home', $binding);
    }

}
