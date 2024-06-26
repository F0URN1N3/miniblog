<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    //資料表名稱
    protected $table = 'users';

    //主鍵名稱
    protected $promaryKey = 'id';

    //可變動欄位
    protected $fillable = [
        'name',
        'email',
        'password',
        'sex',
        'interest',
        'introduce',
        'picture',
        'enable',
    ];

}
