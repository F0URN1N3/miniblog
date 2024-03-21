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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('password', 50);
            $table->string('name', 30);
            $table->tinyInteger('sex')->default(0);
            $table->string('interest', 300)->default('');
            $table->string('introduce', 1000)->default('');
            $table->string('picture', 50)->default('');
            $table->tinyInteger('enable')->default(1);//1.公開 2.好友 3.私密
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
