<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//test to set prod online
Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);

Route::group(['middleware' => 'auth:api'], function(){
    Route::get('posts', [PostController::class, 'allpost']);
    Route::post('addposts', [PostController::class, 'addpost']);
    Route::post('logout', [UserController::class, 'logout']);
    Route::post('deletepost', [PostController::class, 'delete']);
    Route::post('updatepost', [PostController::class, 'update']);
});