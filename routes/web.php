<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProfileController;

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

Route::get('/profile', function () {
    return view('profile');
})->name('profile');;

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['prefix' => 'admin', 'middleware' => ['role:moderator']], function () {
    Route::get('/dashboard', function() {
       return view('dashboard');
    })->name('dashboard');
    Route::get('/article', [ArticleController::class, 'index'])->name('article.index');
    Route::get('/article/create', [ArticleController::class, 'create'])->name('create');
    Route::post('/article/store', [ArticleController::class, 'store'])->name('article.store'); 
    Route::get('/article/show/{id}',  [ArticleController::class, 'show'])->name('article.show');
    Route::get('/article/edit/{id}', [ArticleController::class, 'edit'])->name('article.edit');    
    Route::post('/article/update/{id}', [ArticleController::class, 'update'])->name('article.update');
    Route::post('/article/destroy/{id}', [ArticleController::class, 'destroy'])->name('article.destroy');
});


Route::get('/article', [ArticleController::class, 'index'])->name('article.index')->middleware('auth');
Route::get('/article/show/{id}',  [ArticleController::class, 'show'])->name('article.show');

// Create Data
Route::group(['middleware' => ['permission:create articles']], function () {
    Route::get('/article/create', [ArticleController::class, 'create'])->name('create');
    Route::post('/article/store', [ArticleController::class, 'store'])->name('article.store'); 
});

// Edit Data
Route::group(['middleware' => ['permission:edit articles']], function () {
    Route::get('/article/edit/{id}', [ArticleController::class, 'edit'])->name('article.edit');
    Route::put('/article/update/{id}', [ArticleController::class, 'update'])->name('article.update');
});

// Hapus Data 
Route::delete('/article/destroy/{id}', [ArticleController::class, 'destroy'])->name('article.destroy');





Route::get('create-article', function() {
    dd('ini khusus create');
})->middleware('can:create articles');

Route::get('edit-article', function() {
    dd('ini khusus edit');
})->middleware('can:edit articles');

Route::get('delete-article', function() {
    dd('ini khusus delete');
})->middleware('can:delete articles');

