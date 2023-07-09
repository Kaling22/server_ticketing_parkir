<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class DashboardAdminController extends Controller
{
    public function index()
    {
        //return view ('admin.index');
        return view ('layouts.main');
    }
    public function home()
    {
        //return view ('admin.index');
        return view ('admin.index');
    }
}
