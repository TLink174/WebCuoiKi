<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

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

Route::get('/home', [UserController::class, 'index'])->name('welcome');

Route::get('/add',[UserController::class, 'add'])->name('admin.home.index');
Route::post('/create', [UserController::class, 'createPost'])->name('admin.home.index-post');
Route::get('/delete', [UserController::class, 'destroy'])->name('delete');

Route::group(['prefix' => '/'], function (){
    Route::get('/', [HomeController::class, 'homePage'])->name('home.index');
    Route::get('/detail/{id}', [HomeController::class, 'detailPage'])->name('home.detail');
});

Route::get('/admin/login', [UserController::class, 'login'])->name('admin.auth.login');
Route::post('/admin/login-post', [UserController::class, 'loginPost'])->name('admin.auth.login-post');
Route::get('/admin/register', [UserController::class, 'register'])->name('admin.auth.register');
Route::post('/admin/register-post', [UserController::class, 'registerPost'])->name('admin.auth.register-post');
Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth']], function () {
    Route::get('/logout', [UserController::class, 'logout'])->name('admin.auth.logout');
    Route::get('/index', [UserController::class, 'index'])->name('admin.index');
    Route::get('/file-manager', [UserController::class, 'fileManager'])->name('admin.file-manager.index');
});


Route::group(['prefix' => 'admin', 'middleware' => []], function () {

    Route::group(['prefix' => 'category'], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('admin.categories.index');
        Route::get('/create', [CategoryController::class, 'create'])->name('admin.categories.create');
        Route::post('/store', [CategoryController::class, 'store'])->name('admin.categories.store');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('admin.categories.edit');
        Route::post('/update/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');
        Route::get('/delete/{id}', [CategoryController::class, 'destroy'])->name('admin.categories.delete');
        Route::get('/restore/{id}', [CategoryController::class, 'restore'])->name('admin.categories.restore');
    });

});
