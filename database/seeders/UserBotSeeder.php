<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserBotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i=1; $i<=20; $i++){
            $number= str_pad($i, 2, "0", STR_PAD_LEFT);

            DB::table('users')->insert([
                'email'=> "bot{$number}@email.com",
                'password'=> Hash::make('123123'),
                'name'=> "bot{$number}",
                'sex'=> $i%2=== 1? 1:2,
                'interest'=> "參加活動",
                'introduce'=> "我是機器人，機油好難喝",
                'picture'=> "images/UserPictures/bot.png",
                'enable'=> 1,
                'created_at'=> now(),
                'updated_at'=> now(),
            ]);
        }
    }
}
