<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\data_mahasiswa;
use App\Http\Controllers\Admin\data_kendaraan;
use App\Http\Controllers\Admin\data_parkir;
use App\Http\Controllers\Admin\data_petugas_parkir;
use App\Http\Controllers\Admin\data_staff;
use App\Http\Controllers\Admin\auth_si;


Route::get('/', function () {
    return view('login/auth-login-basic');
});
Route::post('actionlogin', [auth_si::class, 'actionlogin'])->name('actionlogin');
Route::get('actionlogout', [auth_si::class, 'actionlogout'])->name('actionlogout')->middleware('auth');
//Admin
    //Dashboard
    Route::resource('dashboardAdmin', DashboardAdminController::class);
    Route::get('Home', [DashboardAdminController::class, 'Home'])->name('Home');
    //Route Untuk Data Mahasiswa
    Route::resource('dataMahasiswa', data_mahasiswa::class);
    //Route Untuk Data Kendaraan
    Route::resource('dataKendaraan', data_kendaraan::class);
    //Route Untuk Data Parkir
    Route::get('/aktif', [data_parkir::class,'aktif'])->name('dataParkir.aktif');
    Route::get('/nonaktif', [data_parkir::class,'nonaktif'])->name('dataParkir.nonaktif');
    //Route Untuk Data Petugas
    Route::resource('dataPetugas', data_petugas_parkir::class);
    //Route Untuk Data Staff
    Route::resource('dataStaff', data_staff::class);
