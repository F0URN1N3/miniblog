<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\NewsfeedController;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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

//需要登入的頁面先通過中介層確保已登入
Route::middleware(['auth.admin'])->group(function () {
    Route::group(['prefix' => 'admin'], function(){
        //自我介紹相關
        Route::group(['prefix' => 'user'], function(){
            //自我介紹頁面
            Route::get('/', [AdminController::class, 'editUserPage']);
            //處理自我介紹資料
            Route::post('/', [AdminController::class, 'editUserProcess']);
        });
            //心情隨筆相關
        Route::group(['prefix' => 'newsfeed'], function(){
            //心情隨筆列表頁面
            Route::get('/', [AdminController::class, 'newsfeedListPage']);
            //新增心情隨筆資料
            Route::get('/add', [AdminController::class, 'addNewsfeedPage']);
            //處理心情隨筆資料
            Route::post('/edit', [AdminController::class, 'editNewsfeedProcess']);
            //單一資料
            Route::group(['prefix' => '{newsfeed_id}'], function(){
                //編輯心情隨筆資料
                Route::get('/edit', [AdminController::class, 'editNewsfeedPage']);
                //刪除心情隨筆資料
                Route::get('/delete', [AdminController::class, 'deleteNewsfeedProcess']);
            });
        });
    });
});

//首頁
Route::controller(HomeController::class)->group(function(){
    Route::get('/', 'indexPage');
    Route::prefix('/{user_id}')->group(function(){
        Route::get('/user', 'userPage');
        Route::get('/newsfeed', 'newsfeedPage');
        Route::get('/board', 'boardPage');
    });
});

//留言回應
Route::get('/comment', function () {
    return view('/comment/comment');
});
Route::controller(CommentController::class)->group(function(){
    Route::prefix('/{nf_id}')->group(function(){
        Route::prefix('/comment')->group(function(){
            Route::get('/', 'listComment');
            Route::get('/load-more', 'loadMoreComment');
            Route::post('/', 'insertComment');
            Route::get('/delete', 'deleteComment');
        });
    });
});
Route::get('/newsfeed', [NewsfeedController::class, 'index']);
Route::get('/newsfeed/{id}/comments', [NewsfeedController::class, 'getComments']);
Route::post('/newsfeed/{id}/comments', [NewsfeedController::class, 'storeComment']);

//圖片上傳測試
Route::controller(ImageController::class)->group(function(){
    Route::get('/image-upload', 'index')->name('image.form');
    Route::post('/image-upload', 'storeImage')->name('image.store');
});
//自動創建大量帳戶
Route::get('/auto', function () {
    $u_pwd= Hash::make('123123');
    for($i=3; $i<30; $i++){
        $data=
        [
            'email'=> 'user'.$i.'@email.com',
            'password'=> $u_pwd,
            'name'=> 'user'.$i,
        ];

        User::insert($data);
    }
    echo "auto fill sucsess!";
});
