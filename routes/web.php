<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Guest\HomeController as GuestHomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/', [ AdminDashboardController::class, 'home'])->name('home');
    Route::get('/posts/deleted', [PostController::class, 'deletedIndex'])->name('posts.deleted');
    Route::delete('/posts/deleted/{id}', [PostController::class, 'restore'])->name('posts.restore');
    Route::resource('/posts', PostController::class);
});

Route::name('guest.')->group(function () {
    Route::get('/', [ GuestHomeController::class, 'home'])->name('home');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
