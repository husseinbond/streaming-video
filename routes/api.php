<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::get('/maps', function () {
    $lat = $request->lat;
    $long = $request->long;
    $location = ["lat" => $lat , "long" => $long];
    event(new Sendposition($location));

    return response()->json(['status' => 'success' , 'data'  => $location ]);
});





Route::post('/cov', 'convController@store')->name('cov');