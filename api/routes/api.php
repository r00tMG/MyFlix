<?php

use App\Http\Controllers\RatingController;
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

#Routes public
Route::post('register',[\App\Http\Controllers\Api\AuthController::class,'register'])->name('register');
Route::post('login',[\App\Http\Controllers\Api\AuthController::class,'login'])->name('login');

#Routes protected


Route::group(['middleware' => ['auth:sanctum']],function (){
    Route::apiResource('ratings',RatingController::class);
    Route::get('/films/{film}/ratings', [RatingController::class, 'index']);
    Route::apiResource('favorites',\App\Http\Controllers\FavoriteController::class)->except('create','show','edit','update');
    Route::resource('films',\App\Http\Controllers\FilmController::class);
    Route::post('logout',[\App\Http\Controllers\Api\AuthController::class,'logout'])->name('logout');
    Route::resource('users',\App\Http\Controllers\Api\AuthController::class);
    Route::resource('roles',\App\Http\Controllers\RoleController::class);
    Route::resource('v1',\App\Http\Controllers\UserController::class);
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
