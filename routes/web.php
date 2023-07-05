<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;
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
Route::get('login', function () {
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

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);
 
    $status = Password::sendResetLink(
        $request->only('email')
    );
 
    return $status === Password::RESET_LINK_SENT
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', function ($token) {
    return view('auth.reset-password', ['token' => $token]);
    // return 'berhasil';
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);
 
    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));
 
            $user->save();
 
            event(new PasswordReset($user));
        }
    );
 
    return $status === Password::PASSWORD_RESET
                ? redirect('/')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');