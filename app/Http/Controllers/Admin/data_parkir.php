<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tb_parkir;


class data_parkir extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function aktif()
    {
        $parkir_aktif = tb_parkir::where('status_masuk','=','1')->get();
        return view('admin.Menus.DataParkir.data-parkir-aktif',compact('parkir_aktif'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function nonaktif()
    {
        $parkir_non_aktif = tb_parkir::where('status_keluar','=','1')->get();
        return view('admin.Menus.DataParkir.data-parkir-non-aktif',compact('parkir_non_aktif'));
    }
}
