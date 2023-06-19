<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Auth\ApiAuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['json.response']], function () {
    // ...
    // public routes
    Route::post('/login', [ApiAuthController::class,'login'])->name('login.api');
    Route::post('/register',[ApiAuthController::class,'register'])->name('register.api');

    // protected routes
    Route::middleware('auth:api')->group(function () {
        Route::post('/logout', [ApiAuthController::class,'logout'])->name('logout.api');

        Route::get('articles', [ArticleController::class,'index']);
        Route::get('articles/{article}', [ArticleController::class,'show']);
        Route::post('articles', [ArticleController::class,'store']);
        Route::put('articles/{article}', [ArticleController::class,'update']);
        Route::delete('articles/{article}', [ArticleController::class,'delete']);
    });


});

