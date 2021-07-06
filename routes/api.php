<?php

use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ReviewController;
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

Route::prefix('v1')->group(function () {
    Route::get('/books/discounts', [BookController::class, 'getDiscountBooks']);
    Route::get('/books/popularity', [BookController::class, 'getPopularBooks']);
    Route::get('/books/recommendation', [BookController::class, 'getRecommendedBooks']);

    Route::resource('books', BookController::class)->only([
        'index', 'show',
    ]);
    Route::resource('categories', CategoryController::class)->only([
        'index',
    ]);
    Route::resource('orders/{book_id}', OrderController::class)->only([
        'store',
    ]);
    Route::resource('reviews/{book_id}', ReviewController::class)->only([
        'index', 'store',
    ]);
    Route::resource('authors', AuthorController::class)->only([
        'index',
    ]);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
