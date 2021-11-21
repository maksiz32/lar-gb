<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\News\NewsController;
use App\Http\Controllers\Feedback\FeedbackController;
use App\Http\Controllers\Order\OrderController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Account\AccountController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ParserController;
use App\Http\Controllers\SocialAuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('main');

Auth::routes();
Route::group(['middleware' => 'guest'], function() {
    Route::get('/facebook', [SocialAuthController::class, 'link'])->name('facebook');
    Route::get('/facebook/callback', [SocialAuthController::class, 'callback'])->name('facebook.callback');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/account', AccountController::class)->name('account');

    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'is_admin'], function () {
        Route::get('/index', [AdminController::class, 'index'])->name('index');
        Route::get('/users', [UserController::class, 'index'])->name('users');
        Route::get('/user/{user}', [UserController::class, 'userEdit']);
        Route::put('/user/save', [UserController::class, 'store'])->name('user');

        Route::get('/categories', [CategoryController::class, 'list'])->name('categories');
        Route::get('/orders', [OrderController::class, 'list'])->name('orders');
        Route::get('/feedbacks', [FeedbackController::class, 'list'])->name('feedbacks');
        Route::get('/news', [NewsController::class, 'list'])->name('news');
        Route::get('/parse', [ParserController::class, 'list'])->name('parse');
        Route::get('/yandex-parse', [ParserController::class, 'yandexParse']);
    });
});

Route::group(['prefix' => '/categories', 'as' => 'categories.'], function () {
    Route::get('/', [CategoryController::class, 'categories']);
    Route::get('/create', [CategoryController::class, 'create']);
    Route::get('/edit/{category}', [CategoryController::class, 'edit']);
    Route::delete('/delete/{category}', [CategoryController::class, 'destroy']);
    Route::put('/save', [CategoryController::class, 'store'])->name('update');
    Route::post('/create', [CategoryController::class, 'input'])->name('input');
});

Route::group(['prefix' => '/news', 'as' => 'news.'], function () {
    Route::get('/cat/{id}', [NewsController::class, 'oneCategory']);
    Route::get('/one/{news}', [NewsController::class, 'showOne']);
    Route::get('/edit/{news}', [NewsController::class, 'edit']);
    Route::delete('/delete/{news}', [NewsController::class, 'destroy']);
    Route::get('/create', [NewsController::class, 'create']);
    Route::put('/save', [NewsController::class, 'store'])->name('update');
    Route::post('/input', [NewsController::class, 'input'])->name('input');
});

Route::group(['prefix' => '/feedback', 'as' => 'feedback.'], function () {
    Route::get('/', [FeedbackController::class, 'all']);
    Route::get('/show/{feedback}', [FeedbackController::class, 'show']);
    Route::get('/edit/{feedback}', [FeedbackController::class, 'edit']);
    Route::delete('/delete/{feedback}', [FeedbackController::class, 'destroy']);
    Route::get('/input', [FeedbackController::class, 'input']);
    Route::put('/update', [FeedbackController::class, 'update'])->name('update');
    Route::post('/create', [FeedbackController::class, 'create'])->name('create');
});

Route::group(['prefix' => '/order', 'as' => 'order.'], function () {
    Route::get('/', [OrderController::class, 'index']);
    Route::get('/edit/{order}', [OrderController::class, 'edit']);
    Route::delete('/delete/{id}', [OrderController::class, 'destroy']);
    Route::get('/create', [OrderController::class, 'create']);
    Route::put('/update', [OrderController::class, 'update'])->name('update');
    Route::post('/input', [OrderController::class, 'input'])->name('input');
});

Route::group(['prefix' => '/parse', 'as' => 'parse.'], function () {
    Route::get('/valutas', [ParserController::class, 'valutas'])->name('valutas');
    Route::get('/create', [ParserController::class, 'create'])->name('create');
    Route::post('/input', [ParserController::class, 'input'])->name('input');
    Route::get('/edit/{resource}', [ParserController::class, 'edit'])->name('edit');
    Route::put('/update', [ParserController::class, 'update'])->name('update');
    Route::delete('/delete/{resource}', [ParserController::class, 'destroy']);

    Route::get('/yandex', [ParserController::class, 'yandex']);
});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['auth']], function () {
    \Unisharp\Laravelfilemanager\Lfm::routes();
});
