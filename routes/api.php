<?php

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth',
    'namespace' => 'App\Http\Controllers\Auth',

], function () {

    Route::any('login', 'AuthController@login');

});


Route::group([

    'middleware' => 'api',
    'prefix' => 'records',
    'namespace' => 'App\Http\Controllers\Record',

], function () {

    Route::resource('', 'RecordController');

});


