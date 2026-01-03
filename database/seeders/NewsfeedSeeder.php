<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsfeedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i=7; $i<=26; $i++){
            $j= $i-6;
            $number= str_pad($j, 2, "0", STR_PAD_LEFT);

            DB::table('newsfeeds')->insert([
                'u_id'=> $i,
                'content'=> "bot{$number}：機器人灌水大軍入侵",
                'enable'=> 1,
                'created_at'=> '2025-09-10',
                'updated_at'=> '2025-09-10',
            ]);
        }
    }
}
