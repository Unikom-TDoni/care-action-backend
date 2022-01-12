<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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

Route::group(['prefix' => 'admin'], function () 
{    
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');

    Route::group(['prefix' => 'quotes'], function () 
    {
        Route::get('/', [AdminController::class, 'quotes'])->name('quotes');
        Route::post('data', [AdminController::class, 'getDataQuotes'])->name('quotes.data');
        Route::post('save', [AdminController::class, 'saveQuotes'])->name('quotes.save');
        Route::post('delete', [AdminController::class, 'deleteQuotes'])->name('quotes.delete');
    });
    
    Route::group(['prefix' => 'activity'], function () 
    {
        Route::get('/', [AdminController::class, 'activity'])->name('activity');
        Route::post('data', [AdminController::class, 'getDataActivity'])->name('activity.data');
        Route::post('save', [AdminController::class, 'saveActivity'])->name('activity.save');
        Route::post('delete', [AdminController::class, 'deleteActivity'])->name('activity.delete');
    });

    Route::group(['prefix' => 'category'], function () 
    {
        Route::get('/', [AdminController::class, 'category'])->name('category');
        Route::post('data', [AdminController::class, 'getDataCategory'])->name('category.data');
        Route::post('save', [AdminController::class, 'saveCategory'])->name('category.save');
        Route::post('delete', [AdminController::class, 'deleteCategory'])->name('category.delete');
    });

    Route::group(['prefix' => 'news'], function () 
    {
        Route::get('/', [AdminController::class, 'news'])->name('news');
        Route::get('add', [AdminController::class, 'showDataNews'])->name('news.add');
        Route::get('detail/{id}', [AdminController::class, 'showDataNews'])->name('news.detail');
        Route::post('save', [AdminController::class, 'saveNews'])->name('news.save');
        Route::post('delete', [AdminController::class, 'deleteNews'])->name('news.delete');
        Route::post('recommended', [AdminController::class, 'setRecommendedNews'])->name('news.recommended');
    });

    Route::group(['prefix' => 'customer'], function () 
    {
        Route::get('/', [AdminController::class, 'customer'])->name('customer');
        Route::post('data', [AdminController::class, 'getDataCustomer'])->name('customer.data');
    });

    Route::group(['prefix' => 'users'], function () 
    {
        Route::get('/', [AdminController::class, 'users'])->name('users');
        Route::post('data', [AdminController::class, 'getDataUsers'])->name('users.data');
        Route::post('save', [AdminController::class, 'saveUsers'])->name('users.save');
        Route::post('delete', [AdminController::class, 'deleteUsers'])->name('users.delete');
        Route::post('password', [AdminController::class, 'changePasswordUsers'])->name('users.password');
    });
});

require __DIR__.'/auth.php';
