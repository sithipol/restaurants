<?php

use App\Http\Controllers\RestaurantController;
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

Route::get('restaurants', [RestaurantController::class, 'index']);
// https://maps.googleapis.com/maps/api/place/textsearch/json?query=restautants%20in%20BangSue&key=AIzaSyAtx7gjQL-l_rGENd8bjUqk2DRtdAbWxqY