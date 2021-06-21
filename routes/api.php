<?php

use App\Http\Controllers\Api\BookController;
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
Route::get('/discount-books', [BookController::class, 'getDiscountBooks']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
