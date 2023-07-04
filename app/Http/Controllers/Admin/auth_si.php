<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Auth;
use App\Models\User;
use Session;

class auth_si extends Controller
{
    public function actionlogin(Request $request)
    {
        $data = [
            'email'=>$request->email,
            'password'=>$request->password
        ];

        if (Auth::attempt($data)) {
            return redirect('Home');
        }else{
            Session::flash('error', 'Email atau Password Salah');
            return redirect('/');
        }
    }

    public function actionlogout()
    {
        Auth::logout();
        return redirect('/');
    }
}
