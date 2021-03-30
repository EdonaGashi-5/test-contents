<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;

use App\Http\Controllers\AuthController;

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


Route::post('/auth/login', [AuthController::class, 'login']);

Route::get('/guest/articles', [ArticleController::class, 'indexGuest']);

Route::get('/guest/articles/{id}', [ArticleController::class, 'showGuest']);


Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request){
        return $request->user();
    });


    Route::get('/articles', [ArticleController::class, 'index']);

    Route::post('/articles', [ArticleController::class, 'store']);

    Route::get('/articles/{id}', [ArticleController::class, 'show']);

    Route::patch('/articles/{id}', [ArticleController::class, 'update']);

    Route::delete('/articles/{id}', [ArticleController::class, 'destroy']);

    Route::apiResource('categories', CategoryController::class);

});









