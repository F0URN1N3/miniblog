<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserAuthController;

//首頁
// Route::get('/', 'HomeController@indexPage');
Route::get('/', [HomeController::class, 'indexPage']);

//使用者
// Route::get('/user/auth/sign-up', 'UserAuthController@signUpPage');
// Route::post('/user/auth/sign-up', 'UserAuthController@signUpProcess');
// Route::get('/user/auth/sign-in', 'UserAuthController@signInPage');
// Route::post('/user/auth/sign-in', 'UserAuthController@signInProcess');
// Route::get('/user/auth/sign-out', 'UserAuthController@signOut');
//  ↓group化寫法
// Route::group(['prefix' => 'user'], function(){
//     //使用者驗證
//     Route::group(['prefix' => 'auth'], function(){
//         Route::get('/sign-up', 'UserAuthController@signUpPage');
//         Route::post('/sign-up', 'UserAuthController@signUpProcess');
//         Route::get('/sign-in', 'UserAuthController@signInPage');
//         Route::post('/sign-in', 'UserAuthController@signInProcess');
//         Route::get('/sign-out', 'UserAuthController@signOut');
//     });
// });

//新版group化寫法
Route::controller(UserAuthController::class)->group(function(){
    Route::prefix('user')->group(function(){
        Route::prefix('auth')->group(function(){
            Route::get('sign-up', 'signUpPage');
            Route::post('sign-up', 'signUpProcess');
            Route::get('sign-in', 'signInPage');
            Route::post('sign-in', 'signInProcess');
            Route::get('sign-out', 'signOut');
        });
    });
});
