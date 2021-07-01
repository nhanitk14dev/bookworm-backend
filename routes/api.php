<?php

use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\CategoryController;
use Illuminate\Http\Request;

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
use Illuminate\Support\Facades\Route;

// Route definition...
Route::get('/books', [BookController::class, 'index']);
Route::get('/book/{slug}', [BookController::class, 'show']);
Route::get('/discount-books', [BookController::class, 'getDiscountBooks']);
Route::get('/recommended-books', [BookController::class, 'getRecommendedBooks']);
Route::get('/popular-books', [BookController::class, 'getPopularBooks']);
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/authors', [AuthorController::class, 'index']);
Route::get('/reviews/{book_id}', [BookController::class, 'getReviews']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
