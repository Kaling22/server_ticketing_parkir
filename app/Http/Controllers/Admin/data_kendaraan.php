<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tb_kendaraan;
use Illuminate\Support\Facades\DB;

class data_kendaraan extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kendaraan = tb_kendaraan::all();
        return view('admin.Menus.DataKendaraan.data-kendaraan',compact('kendaraan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.Menus.DataKendaraan.create-data-kendaraan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $kendaraan = tb_kendaraan::all();
        tb_kendaraan::create([
            'no_kendaraan' => $request->no_kendaraan,
        ]);
        return redirect()->route('dataKendaraan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kendaraan = tb_kendaraan::find($id);
        return view('admin.Menus.DataKendaraan.edit-data-kendaraan',compact('kendaraan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $kendaraan = tb_kendaraan::find($id);
        // $kendaraan = tb_kendaraan::find($kendaraan->id);
        $kendaraan->update($request->all());
        // if ($kendaraan) {
        //     Alert::success('Data Berhasil Diubah');
            return redirect()->route('dataKendaraan.index');
        // } else {
        //     Alert::error('Data Gagal Diubah');
        //     return redirect()->route('dataKendaraan.edit', $kendaraan->id);
        // }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = tb_kendaraan::find($id);
        $delete->delete();
        return redirect()->route('dataKendaraan.index');
    }
}
