<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\User;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function GetUserData()
    {
        //取得會員編號
        $user_id = session()->get('user_id');

        if(is_null($user_id))
        {
            return null;
        }

        $User = User::where('id', $user_id)->first();

        return $User;
    }

}
