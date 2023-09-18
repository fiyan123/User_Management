<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
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

Auth::routes();

Route::get('/', [App\Http\Controllers\FrontendController::class, 'index']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Profile
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::get('/profile/create', [ProfileController::class, 'create'])->name('create');
Route::post('/profile/store', [ProfileController::class, 'store'])->name('profile.store');
Route::get('/profile/edit/{id}', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/profile/update/{id}', [ProfileController::class, 'update'])->name('profile.update');


Route::group(['prefix' => 'admin', 'middleware' => ['role:moderator']], function () {
    Route::get('/dashboard', function() {
       return view('dashboard');
    })->name('dashboard');
    Route::get('/article/filter', [ArticleController::class, 'getFilteredData'])->name('article.getFilteredData');
    Route::get('/article', [ArticleController::class, 'index'])->name('article.index');
    Route::get('/article/create', [ArticleController::class, 'create'])->name('create');
    Route::post('/article/store', [ArticleController::class, 'store'])->name('article.store'); 
    Route::get('/article/show/{id}',  [ArticleController::class, 'show'])->name('article.show');
    Route::get('/article/edit/{id}', [ArticleController::class, 'edit'])->name('article.edit');    
    Route::post('/article/update/{id}', [ArticleController::class, 'update'])->name('article.update');

    // Role Permissions Users
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    Route::put('/users/{user}/roles-permissions', [UserController::class,'updateRolesAndPermissions'])->name('usersRolePermission.update');
    Route::delete('/users/destroy/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    // Permissions Users
    Route::get('/permissions', [PermissionsController::class, 'index'])->name('permission.index');
    Route::post('/permissions/store', [PermissionsController::class, 'store'])->name('permission.store');
    Route::get('/permissions/edit/{id}', [PermissionsController::class, 'edit'])->name('permission.edit');  
    Route::put('/permissions/update/{id}', [PermissionsController::class, 'update'])->name('permission.update'); 
    Route::delete('/permissions/{id}', [PermissionsController::class, 'destroy'])->name('permission.destroy');

    // Role Users
    Route::get('/roles', [RoleController::class, 'index'])->name('role.index');
    Route::post('/roles/store', [RoleController::class, 'store'])->name('role.store');
    Route::get('/roles/edit/{id}', [RoleController::class, 'edit'])->name('role.edit');  
    Route::put('/roles/update/{id}', [RoleController::class, 'update'])->name('role.update');  
    Route::delete('/roles/{id}', [RoleController::class, 'destroy'])->name('role.destroy');
});


// Article
Route::get('/article/filter', [ArticleController::class, 'getFilteredData'])->name('article.getFilteredData');
Route::get('/article', [ArticleController::class, 'index'])->name('article.index')->middleware('auth');
Route::get('/article/filter', [ArticleController::class, 'filter'])->name('article.filter');
Route::post('/article/store', [ArticleController::class, 'store'])->name('article.store'); 
Route::get('/article/show/{id}',  [ArticleController::class, 'show'])->name('article.show');

// Create Data
Route::get('/article/create', [ArticleController::class, 'create'])->name('create');

// Edit Data
Route::get('/article/edit/{id}', [ArticleController::class, 'edit'])->name('article.edit');
Route::put('/article/update/{id}', [ArticleController::class, 'update'])->name('article.update');

Route::post('destroy', [ArticleController::class, 'destroy'])->name('article.delete');





