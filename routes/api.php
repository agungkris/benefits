<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', 'AuthController@login');
Route::group(['prefix' => 'auth', 'middleware' => 'auth:sanctum'], function() {
    // manggil controller sesuai bawaan laravel 8
    Route::post('logout', [AuthController::class, 'logout']);
    // manggil controller dengan mengubah namespace di RouteServiceProvider.php biar bisa kayak versi2 sebelumnya
    Route::post('logoutall', 'AuthController@logoutall');
});
Route::prefix('/auth')->group(function () {
    Route::get('/', 'AuthController@getUser')->middleware('auth:sanctum');
});
Route::prefix('/users')->group(function(){
    Route::get('/', 'usersController@index');
    Route::post('/create', 'usersController@store');
    Route::post('/update/{id}', 'usersController@update');
    Route::get('/get/{id}', 'usersController@show');
    Route::delete('/delete/{id}', 'usersController@destroy');
    Route::get('/random', 'usersController@random')->middleware('auth:sanctum');
});
