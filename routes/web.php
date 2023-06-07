<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Profile
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::get('/profile/create', [ProfileController::class, 'create'])->name('create');
Route::post('/profile/store', [ProfileController::class, 'store'])->name('profile.store');


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

    // Users
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');

    // Permissions Users
    Route::put('/users/{user}/permissions', [UserController::class, 'update'])->name('permissions.update');
    Route::post('/permissions/store', [UserController::class, 'storePermission'])->name('permissions.store');

    // Role Users
    Route::post('/role/store', [UserController::class, 'storeRole'])->name('role.store');
    Route::put('/users/{user}/role', [UserController::class, 'updateRole'])->name('role.update');
});


// Article
Route::get('/article', [ArticleController::class, 'index'])->name('article.index')->middleware('auth');
Route::post('/article/store', [ArticleController::class, 'store'])->name('article.store'); 
Route::get('/article/show/{id}',  [ArticleController::class, 'show'])->name('article.show');

// Create Data
Route::group(['middleware' => ['permission:create articles']], function () {
    Route::get('/article/create', [ArticleController::class, 'create'])->name('create');
});

// Edit Data
Route::group(['middleware' => ['permission:edit articles']], function () {
    Route::get('/article/edit/{id}', [ArticleController::class, 'edit'])->name('article.edit');
    Route::put('/article/update/{id}', [ArticleController::class, 'update'])->name('article.update');
});

// Hapus Data 
Route::delete('/article/destroy/{id}', [ArticleController::class, 'destroy'])->name('article.destroy');




