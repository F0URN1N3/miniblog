<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ImageController;

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

Route::group(['prefix' => 'admin'], function(){
    //自我介紹相關
    Route::group(['prefix' => 'user'], function(){
        //自我介紹頁面
        Route::get('/', [AdminController::class, 'editUserPage']);
        //處理自我介紹資料
        Route::post('/', [AdminController::class, 'editUserProcess']);
    });
        //心情隨筆相關
        Route::group(['prefix' => 'mind'], function(){
            //心情隨筆列表頁面
            Route::get('/', 'AdminController@mindListPage');
            //新增心情隨筆資料
            Route::get('/add', 'AdminController@addMindPage');
            //處理心情隨筆資料
            Route::post('/edit', 'AdminController@editMindProcess');
            //單一資料
            Route::group(['prefix' => '{mind_id}'], function(){
                //編輯心情隨筆資料
                Route::get('/edit', 'AdminController@editMindPage');
                //刪除心情隨筆資料
                Route::get('/delete', 'AdminController@deleteMindProcess');
            });
        });

    });

Route::controller(ImageController::class)->group(function(){
    Route::get('/image-upload', 'index')->name('image.form');
    Route::post('/image-upload', 'storeImage')->name('image.store');
});
