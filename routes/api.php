<?php

use App\Http\Controllers\Api\AuthorsController;
use App\Http\Controllers\Api\BooksController;
use App\Http\Controllers\Api\OrdersController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

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
Route::prefix('v1')->group(function () {
    Route::prefix('authors')->group(static function () {
        Route::get('/', [AuthorsController::class, 'index']);
        Route::get('/{author}', [AuthorsController::class, 'show']);
        Route::group(['middleware' => ['auth:sanctum', 'is_admin']], static function () {
            Route::post('/', [AuthorsController::class, 'store']);
            Route::put('/{author}' ,[AuthorsController::class, 'update']);
            Route::delete('/{author}', [AuthorsController::class, 'destroy']);
        });
    });

    Route::prefix('books')->group(static function () {
        Route::get('/', [BooksController::class, 'index']);
        Route::get('/{book}', [BooksController::class, 'show']);
        Route::group(['middleware' => ['auth:sanctum', 'is_admin']], static function () {
            Route::post('/', [BooksController::class, 'store']);
            Route::put('/{book}' ,[BooksController::class, 'update']);
            Route::delete('/{book}', [BooksController::class, 'destroy']);
        });
    });

    Route::prefix('orders')->group(static function () {
        Route::post('/', [OrdersController::class, 'store']);
        Route::post('/{order}', [OrdersController::class, 'setProcessedOrderStatus']);
        Route::post('/{order}', [OrdersController::class, 'setDeliveredOrderStatus']);
        //Route::group(['middleware' => ['auth:sanctum', 'is_admin']], static function () {
            Route::get('/', [OrdersController::class, 'index']);
            Route::get('/{order}', [OrdersController::class, 'show']);
        //});
    });

    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

});

Route::fallback(static function () {
    abort(Response::HTTP_NOT_FOUND, 'API resource not found');
});
