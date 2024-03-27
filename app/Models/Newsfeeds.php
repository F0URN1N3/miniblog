<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newsfeeds extends Model
{
    use HasFactory;

    //資料表名稱
    protected $table = 'newsfeeds';

    //主鍵名稱
    protected $promaryKey = 'id';

    //可變動欄位
    protected $fillable = [
        'u_id',
        'content',
        'enable',
    ];

}
