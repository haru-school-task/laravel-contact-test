<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\Admin\AdminController;

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

// --- 1. 誰でもアクセスできるページ ---
Route::get('/', [InquiryController::class, 'index'])->name('inquiry.index');
Route::post('/confirm', [InquiryController::class, 'confirm'])->name('inquiry.confirm');
Route::post('/thanks', [InquiryController::class, 'store'])->name('inquiry.store');


// --- 2. ログインが必要なページ (管理画面のみ) ---
Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin.index');
        Route::get('/search', [AdminController::class, 'search'])->name('admin.search');
        Route::get('/reset', [AdminController::class, 'reset'])->name('admin.reset');
        Route::post('/delete', [AdminController::class, 'destroy'])->name('admin.delete');
        Route::get('/export', [AdminController::class, 'export'])->name('admin.export');
    });

});

