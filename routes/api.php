<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\APIController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () 
{
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::any('/quotes', [APIController::class, 'getQuotes']);
    Route::any('/category', [APIController::class, 'getDataCategory']);

    Route::group(['prefix' => 'news'], function () 
    {
        Route::any('/', [APIController::class, 'getDataNews']);
        Route::post('/recommended', [APIController::class, 'getRecommendedNews']);
        Route::post('/detail', [APIController::class, 'getDetailNews']);
    });

    Route::group(['prefix' => 'profile'], function () 
    {
        Route::any('/', [APIController::class, 'getProfileCustomer']);
        Route::post('/change', [APIController::class, 'changeProfileCustomer']);
        Route::post('/register', [APIController::class, 'registerProfileCustomer']);
        Route::post('/password', [APIController::class, 'changePasswordCustomer']);
    });

    Route::group(['prefix' => 'activity'], function () 
    {
        Route::any('/', [APIController::class, 'getDataActivity']);
        Route::post('/checklist', [APIController::class, 'setCheckActivity']);
    });
});