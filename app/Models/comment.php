<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    use HasFactory;

        //資料表名稱
        protected $table = 'comments';

        //主鍵名稱
        protected $promaryKey = 'id';

        //可變動欄位
        protected $fillable = [
            'u_id',
            'nf_id',
            'content',
            'enable',
        ];

}
