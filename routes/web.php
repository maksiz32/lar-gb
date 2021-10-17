<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\News\NewsController;

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

Route::prefix('/news')->group(
    function () {
        Route::get('/', [NewsController::class, 'categories']);
        Route::get('/cat/{id}', [NewsController::class, 'oneCategory']);
        Route::get('/one/{id}', [NewsController::class, 'showOne']);
        Route::get('/create', [NewsController::class, 'create']);
        Route::post('/save', [NewsController::class, 'store'])->name('news.input');
    }
);
