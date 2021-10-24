<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\News\NewsController;
use App\Http\Controllers\Feedback\FeedbackController;
use App\Http\Controllers\Order\OrderController;
use App\Http\Controllers\CategoryController;

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
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

//Route::resource('news', NewsController::class);

Route::prefix('/categories')->group(
    function () {
        Route::get('/', [CategoryController::class, 'categories']);
        Route::get('/create', [CategoryController::class, 'create']);
        Route::get('/edit/{category}', [CategoryController::class, 'edit']);
        Route::get('/delete/{category}', [CategoryController::class, 'destroy']);
        Route::match(['post', 'put'], '/save', [CategoryController::class, 'store']);
    });

Route::prefix('/news')->group(
    function () {
        Route::get('/cat/{id}', [NewsController::class, 'oneCategory']);
        Route::get('/one/{news}', [NewsController::class, 'showOne']);
        Route::get('/edit/{news}', [NewsController::class, 'edit']);
        Route::get('/delete/{news}', [NewsController::class, 'destroy']);
        Route::get('/create', [NewsController::class, 'create']);
        Route::match(['post', 'put'], '/save', [NewsController::class, 'store'])->name('news.input');
    }
);

Route::prefix('/feedback')->group(
    function () {
        Route::get('/', [FeedbackController::class, 'list']);
        Route::get('/show/{feedback}', [FeedbackController::class, 'show']);
        Route::get('/edit/{feedback}', [FeedbackController::class, 'edit']);
        Route::get('/delete/{feedback}', [FeedbackController::class, 'destroy']);
        Route::get('/input', [FeedbackController::class, 'input']);
        Route::match(['post', 'put'], '/save', [FeedbackController::class, 'save'])->name('feedback.save');
    }
);

Route::prefix('/order')->group(
    function () {
        Route::get('/', [OrderController::class, 'index']);
        Route::get('/edit/{order}', [OrderController::class, 'edit']);
        Route::get('/delete/{id}', [OrderController::class, 'destroy']);
        Route::get('/input', [OrderController::class, 'create']);
        Route::match(['post', 'put'], '/save', [OrderController::class, 'save'])->name('order.save');
    }
);
