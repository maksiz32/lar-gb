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
        Route::get('/one/{id}', [NewsController::class, 'showOne']);
        Route::get('/edit/{id}', [NewsController::class, 'edit']);
        Route::get('/delete/{id}', [NewsController::class, 'destroy']);
        Route::get('/create', [NewsController::class, 'create']);
        Route::post('/save', [NewsController::class, 'store'])->name('news.input');
    }
);
Route::prefix('/feedback')->group(
    function () {
        Route::get('/', [FeedbackController::class, 'list']);
        Route::get('/show/{id}', [FeedbackController::class, 'show']);
        Route::get('/edit/{id}', [FeedbackController::class, 'input']);
        Route::get('/input/{id?}', [FeedbackController::class, 'input']);
        Route::get('/delete/{id}', [FeedbackController::class, 'destroy']);
        Route::post('/save', [FeedbackController::class, 'save'])->name('feedback.save');
    }
);
Route::prefix('/order')->group(
    function () {
        Route::get('/', [OrderController::class, 'create']);
        Route::post('/save', [OrderController::class, 'save'])->name('order.save');
    }
);
