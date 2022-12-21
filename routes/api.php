<?php

use Illuminate\Http\Request;
use App\Http\Controllers\api\RegisterApiController;
use App\Http\Controllers\api\LoginApiController;
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
Route::post('register', [LoginApiController::class, 'register']);
Route::post('login', [LoginApiController::class, 'login']);
Route::post('profile', [LoginApiController::class, 'profile']);
Route::post('post', [LoginApiController::class, 'article']);
Route::post('updatepost', [LoginApiController::class, 'updateArticle']);
Route::post('delete', [LoginApiController::class, 'deletePost']);