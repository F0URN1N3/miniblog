<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('newsfeeds', function (Blueprint $table) {
            $table->id();
            $table->integer('u_id');
            $table->string('content', 1000)->default('');
            $table->tinyInteger('enable')->default(1);//1.公開 2.好友 3.私密
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('newsfeeds');
    }
};
