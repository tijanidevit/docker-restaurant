<?php

use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\AuthController;
use App\Models\Restaurant;
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
Route::post('register/', [AuthController::class , 'register']);
Route::post('login/', [AuthController::class , 'login']);

Route::get('restaurants', [RestaurantController::class , 'index']);
Route::get('restaurants/{id}/', [RestaurantController::class , 'show']);
Route::get('restaurants/search/{name}/', [RestaurantController::class , 'search']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::post('restaurants/', [RestaurantController::class , 'store']);
    Route::patch('restaurants/{id}/', [RestaurantController::class , 'update']);
    Route::delete('restaurants/{id}/', [RestaurantController::class , 'destroy']);

    Route::get('logout/', [AuthController::class , 'logout']);

});
