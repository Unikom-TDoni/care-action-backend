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

    Route::any('/category', [APIController::class, 'getDataCategory']);
    Route::any('/news', [APIController::class, 'getDataNews']);

    Route::group(['prefix' => 'profile'], function () 
    {
        Route::any('/', function() {
            return auth()->user();
        });
        Route::post('/change', [APIController::class, 'changeProfileCustomer']);
        Route::post('/password', [APIController::class, 'changePasswordCustomer']);
    });
});