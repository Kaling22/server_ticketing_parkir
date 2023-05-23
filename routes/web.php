<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\data_mahasiswa;
use App\Http\Controllers\Admin\data_kendaraan;
use App\Http\Controllers\Admin\data_parkir;


Route::get('/', function () {
    return view('login/auth-login-basic');
});

//Admin
    //Dashboard
    //Route::get('dashboardAdmin', 'DashboardAdminController@index'->name('dash'));
    Route::resource('dashboardAdmin', DashboardAdminController::class);
    Route::resource('dataMahasiswa', data_mahasiswa::class);
    Route::resource('dataKendaraan', data_kendaraan::class);
    Route::resource('dataParkir', data_parkir::class);
    //Route::get('dashboardAdmin/admin', [DashboardAdminController::class, 'index'])->name('dashboardAdmin.index');
    //Route::view('admin.index','DashboardAdminController@index')->name('dashboard');