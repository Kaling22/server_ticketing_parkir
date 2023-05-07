<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\DataAkunController;
use App\Http\Controllers\Admin\DataKendaraanController;
use App\Http\Controllers\Admin\DataRiwayatController;


Route::get('/', function () {
    return view('login/auth-login-basic');
});

//Admin
    //Dashboard
    //Route::get('dashboardAdmin', 'DashboardAdminController@index'->name('dash'));
    Route::resource('dashboardAdmin', DashboardAdminController::class);
    Route::resource('dataAkun', DataAkunController::class);
    Route::resource('dataKendaraan', DataKendaraanController::class);
    Route::resource('dataRiwayat', DataRiwayatController::class);
    //Route::get('dashboardAdmin/admin', [DashboardAdminController::class, 'index'])->name('dashboardAdmin.index');
    //Route::view('admin.index','DashboardAdminController@index')->name('dashboard');