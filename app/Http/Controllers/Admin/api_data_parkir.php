<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\tb_parkir;
use App\Models\tb_mahasiswa;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

use App\Http\Resources\ParkirResource;
use App\Http\Resources\MahasiswaResource;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
class api_data_parkir extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_parkir = tb_parkir::query()
                ->with(['mahasiswa' => function ($query) {
                $query->select('nim','name','nfc_num','nfc_num_ktp','angkatan','foto');
                }])->get();

        return response()->json([
            'status' => 'success ',
            'message' => 'showing all parkir',
            'data' => $data_parkir
        ], Response::HTTP_OK);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'created_by' => 'required|string',
            //'updated_by' => 'required|string',
        ]);

        if($validator->fails()){
            return response()->json([
                "status" => "failed",
                "message" => "failed to create new data parkir",
                "data" => $validator->errors()
            ],Response::HTTP_NOT_ACCEPTABLE);
        }

        if ($request->nim==null) {
            $z=$request->nim;
        }else {
            $z=Str::slug($request->nim);
        }

        if ($request->nfc_num==null) {
            $x=$request->nfc_num;
        }else {
            $x=Str::slug($request->nfc_num);
        }

        if ($request->nfc_num_ktp==null) {
            $y=$request->nfc_num_ktp;
        }else {
            $y=Str::slug($request->nfc_num_ktp);
        }

        if ($request->nim==null && $request->nfc_num==null && $request->nfc_num_ktp==null) {
            return response()->json([
                "success" => false,
                "message" => "Isi salah satu data antara NIM, NFC atau KTP",
                "data" => null
            ],Response::HTTP_NOT_ACCEPTABLE);
        }else {
            //$day = ;
            $resource_parkir = tb_parkir::create([
                'nim' => $z,
                'nfc_num' => $x,
                'nfc_num_ktp' => $y,
                'status_masuk' => 1,
                'status_keluar' => 0,
                'created_by' => Str::slug($request->created_by),
                'updated_by' => Str::slug($request->created_by),
                'hari' => Carbon::now()->isoFormat('dddd'),
                'tanggal' => Carbon::now()->isoFormat('DD - MM - YYYY'),
                'jam' => Carbon::now()->isoFormat('hh:mm:ss')
                ]
            );
            return response()->json([
                'success' => true,
                'message' => 'data parkir created',
                'data' => $resource_parkir
            ], Response::HTTP_CREATED);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($para)
    {
        try{
        
            $data_parkir = tb_parkir::query()
                ->with(['mahasiswa' => function ($query) {
                $query->select('nim','name','nfc_num','nfc_num_ktp','angkatan','foto');
                }])->where('nim', $para)->orWhere('nfc_num',$para)->orWhere('nfc_num_ktp',$para)->latest('created_at')->first();

            return response()->json([
                'success' => true,
                'message' => 'showing data mahasiswa',
                'data' => $data_parkir
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


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $para)
    {
        // $validator = Validator::make($request->all(), [
        //     'nim' => 'required|integer|digits-between:1,18',

        // ]);

        // if($validator->fails()){
        //     return response()->json([
        //         "status" => "failed",
        //         "message" => "failed to update data",
        //         "data" => $validator->errors()
        //     ],Response::HTTP_NOT_ACCEPTABLE);
        // }

        try{
            $parkir = tb_parkir::query()
                ->with(['mahasiswa' => function ($query) {
                $query->select('nim','name','nfc_num','nfc_num_ktp','angkatan','foto');
                }])->where('nim', $para)->orWhere('nfc_num',$para)->orWhere('nfc_num_ktp',$para)->latest('created_at')->first();
            // $parkir = tb_parkir::findorFail($id);
            $parkir->update([
                'updated_by' => Str::slug($request->updated_by),
                'status_masuk' => 0,
                'status_keluar' => 1,
                'hari' => Carbon::now()->isoFormat('dddd'),
                'tanggal' => Carbon::now()->isoFormat('DD - MM - YYYY'),
                'jam' => Carbon::now()->isoFormat('hh:mm:ss')
            ]);
            return response()->json([
                'success' =>  true,
                'message' => 'data updated',
                'data' => $parkir
            ], Response::HTTP_OK);
        }
        catch(\Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'product not found',
                'data'=> $e->getMessage()
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
