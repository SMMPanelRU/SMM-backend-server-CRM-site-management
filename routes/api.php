<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['api'], 'as' => 'api.'], function () {

    Route::get('/products/{product?}', [ProductController::class, 'index'])->name('products');

});


Route::group(['middleware' => ['api'], 'as' => 'api.'], function () {
    $limiter = config('fortify.limiters.login');

    Route::post('/register', [AuthController::class, 'register']);

    Route::post('/login', [AuthController::class, 'login'])
         ->middleware(array_filter([
             $limiter ? 'throttle:' . $limiter : null,
         ]));

    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::get('/me', [UserController::class, 'me']);

        Route::post('/email_verify', [UserController::class, 'emailVerified']);

        Route::group(['prefix' => 'orders'], function () {

            Route::post('/create', [OrderController::class, 'create'])->name('order.create');

        });
    });
});
