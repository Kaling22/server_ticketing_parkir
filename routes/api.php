<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\api_data_parkir;
use App\Http\Controllers\Admin\api_mahasiswa;
use App\Http\Controllers\Admin\akun;
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

Route::post('login', [akun::class, 'login']);
Route::post('register', [akun::class, 'register']);
Route::post('logout',[akun::class,'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//ENDPoint for Parkir
Route::apiResource('parkir', api_data_parkir::class)->middleware('auth:sanctum');
Route::apiResource('mahasiswa', api_mahasiswa::class)->middleware('auth:sanctum');
