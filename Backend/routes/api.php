<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CommentsController;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\ImageController;



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

Route::get('/images/{imageName}', [ImageController::class, 'show'])->name('images.show');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:sanctum')->group(function () {



    Route::resource('articles', ArticleController::class)->except(['create', 'edit', 'update', 'destroy', 'store']);
    Route::resource('categories', CategoryController::class)->except(['create', 'edit', 'update', 'destroy', 'store', 'show']);
    Route::resource('tags', TagController::class)->except(['create', 'edit', 'update', 'destroy', 'store', 'show']);
    Route::resource('comments', CommentsController::class)->except(['create', 'edit']);

    Route::get('articles-latest', [ArticleController::class, 'latest']);
});
