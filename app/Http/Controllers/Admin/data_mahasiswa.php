<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tb_mahasiswa;
use App\Models\tb_kendaraan;
use App\Models\tb_parkir;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use \Log;
use PDF;
class data_mahasiswa extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mahasiswa = tb_mahasiswa::all();
        
        return view('admin.Menus.DataMahasiswa.data-mahasiswa',compact('mahasiswa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.Menus.DataMahasiswa.create-data-mahasiswa');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        // validasi format gambar
        $this->validate($request, [
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $image = $request->file('foto');
        $image->storeAs('public/posts', $image->hashName());
        $mahasiswa = new tb_mahasiswa;
        $plat = implode(",", $request->kendaraan);
        tb_mahasiswa::create([
            'foto' => $image->hashName(),
            'nim' => $request->nim,
            'nfc_num' => $request->nfc_num,
            'nfc_num_ktp' => $request->nfc_num_ktp,
            'name' => $request->name,
            'jurusan' => $request->jurusan,
            'fakultas' => $request->fakultas,
            'angkatan' => $request->angkatan,
            'telepon' => $request->telepon,
            'status_mahasiswa' => $request->status_mahasiswa,
            'kendaraan' => $plat
        ]);
        
        return redirect()->route('dataMahasiswa.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mahasiswa = tb_mahasiswa::find($id);

        $plat = tb_mahasiswa::query()->select('kendaraan')
        ->Where('id', $id)->first();

        $explode_id = explode(',', $plat->kendaraan);
        return view('admin.Menus.DataMahasiswa.edit-data-mahasiswa',compact('mahasiswa','explode_id'));
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
        $mahasiswa = tb_mahasiswa::find($id);
        // validasi format gambar
        $this->validate($request, [
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
       // $mahasiswa = new tb_mahasiswa;
        $plat = implode(",", $request->kendaraan);

        $image = $request->file('foto');
       // $image = $request->('foto');
        $image->storeAs('public/posts/', $image->hashName());
        Storage::delete('public/posts/'.$mahasiswa->foto);
        $mahasiswa->update([
            'foto' => $image->hashName(),
            'nim' => $request->nim,
            'nfc_num' => $request->nfc_num,
            'nfc_num_ktp' => $request->nfc_num_ktp,
            'name' => $request->name,
            'jurusan' => $request->jurusan,
            'fakultas' => $request->fakultas,
            'angkatan' => $request->angkatan,
            'telepon' => $request->telepon,
            'status_mahasiswa' => $request->status_mahasiswa,
            'kendaraan' =>$plat,
        ]);
        $mahasiswa = tb_mahasiswa::find($id);
        
        return redirect()->route('dataMahasiswa.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = tb_mahasiswa::find($id);
        Storage::delete('public/posts/'.$delete->foto);
        $delete->delete();
        return redirect()->route('dataMahasiswa.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($nim)
    {
        $riwayatMahasiswa = tb_parkir::select('nim','status_keluar','tanggal','jam','created_by','updated_by')->where('nim', $nim)->get();
        foreach ($riwayatMahasiswa as $status) {
            switch ($status->status_keluar) {
                case '0':
                    $sts[] = 'Terparkir';
                    break;
                case '1':
                    $sts[] = 'Tidak Terparkir';
                    break;
            }
        }
        // Table::select('name','surname')->where('id', 1)->get();
    	$pdf = PDF::loadview('admin.Menus.DataMahasiswa.mahasiswa_pdf',compact('riwayatMahasiswa','sts'));
    	return $pdf->stream('laporan-parkir-pdf');
    }

}
