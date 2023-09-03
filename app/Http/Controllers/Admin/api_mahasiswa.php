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
           $plat = tb_mahasiswa::query()->select('kendaraan')
            ->orWhere('nim', $para)->orWhere('nfc_num',$para)->orWhere('nfc_num_ktp',$para)->latest('created_at')->first();

            $explode_id = explode(',', $plat->kendaraan);
            $data_mahasiswa = array_merge($explode_id);

            $sql_mahasiswa = tb_mahasiswa::select('nim','name','jurusan','fakultas','nfc_num','nfc_num_ktp','angkatan','foto')
                ->orWhere('nim', $para)->orWhere('nfc_num',$para)->orWhere('nfc_num_ktp',$para)->latest('created_at')->first();
                $sql_mahasiswa['kendaraan'] = $explode_id;
            return response()->json([
                'success' => true,
                'message' => 'showing data mahasiswa',
                'data' => $sql_mahasiswa,
            ], 200);
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
