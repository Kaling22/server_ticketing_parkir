<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tb_mahasiswa;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use App\Models\User;
class api_mahasiswa extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($para)
    {
        try{
            $data_mahasiswa = tb_mahasiswa::query()
                ->select('nim','name','jurusan','fakultas','nfc_num','nfc_num_ktp','angkatan','foto')
                ->orWhere('nim', $para)->orWhere('nfc_num',$para)->orWhere('nfc_num_ktp',$para)->latest('created_at')->first();

            return response()->json([
                'success' => true,
                'message' => 'showing data mahasiswa',
                'data' => $data_mahasiswa
            ], Response::HTTP_OK);
        }
        catch(\Exception $park){
            return response()->json([
                'success' => false,
                'message' => 'data not found',
                'data'=> $park->getMessage()
            ], Response::HTTP_NOT_FOUND);
        }
        
    }
}
