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
                $query->select('nim','name','nfc_num','angkatan','foto');
                }])->get();
        //$resource_parkir = ParkirResource::collection(tb_parkir::all());
        return response()->json([
            'status' => 'success ',
            'message' => 'showing all parkir',
            'data' => $data_parkir
        ], Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        //$request = DB::table('tb_parkirs')->Join('tb_mahasiswas','tb_mahasiswas.nim','=','tb_parkirs.nim')->get($par->all());
        $validator = Validator::make($request->all(), [
            'nim' => 'required|integer|digits-between:1,18',
            'created_by' => 'required|string',
            'updated_by' => 'required|string',
            'hari' => 'required|string',
            'tanggal' => 'required|string',
            'jam' => 'required|string',
        ]);

        if($validator->fails()){
            return response()->json([
                "status" => "failed",
                "message" => "failed to create new data parkir",
                "data" => $validator->errors()
            ],Response::HTTP_NOT_ACCEPTABLE);
        }
        //$par = DB::table('tb_parkirs')->Join('tb_mahasiswas','tb_mahasiswas.nim','=','tb_parkirs.id')->get($request->all());
        $resource_parkir = tb_parkir::create([
            'nim' => Str::slug($request->nim),
            'status_masuk' => 1,
            'status_keluar' => 0,
            'created_by' => Str::slug($request->created_by),
            'updated_by' => Str::slug($request->updated_by),
            'hari' => $request->hari,
            'tanggal' => $request->tanggal,
            'jam' => $request->jam
            ]
        );

        return response()->json([
            'status' => 'success',
            'message' => 'data parkir created',
            'data' => $resource_parkir
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($nim)
    {
        try{
            $data_parkir = tb_parkir::query()
                ->with(['mahasiswa' => function ($query) {
                $query->select('nim','name','nfc_num','angkatan','foto');
                }])->where('nim', $nim)->latest('created_at')->first();
            
            //$data_parkir = tb_parkir::where('nim', $nim)->get();

            // $data_parkir = tb_parkir::select('*')
            // ->where('nim', '=', $nim)
            // ->get();
            // $data = DB::table('tb_parkirs')
            // ->join('nim', 'tb_mahasiswas.nfc_num', '=', '' )
            //$data_parkir = new ParkirResource(tb_parkir::where('nim', $nim)->all());
            return response()->json([
                'status' => 'success ',
                'message' => 'showing data mahasiswa',
                'data' => $data_parkir
            ], Response::HTTP_OK);
        }
        catch(\Exception $park){
            return response()->json([
                'status' => 'failed ',
                'message' => 'data not found',
                'data'=> $park->getMessage()
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $validator = Validator::make($request->all(), [
            'nim' => 'required|integer|digits-between:1,18',
            'created_by' => 'required|string',
            'updated_by' => 'required|string',
            'hari' => 'required|string',
            'tanggal' => 'required|string',
            'jam' => 'required|string',
        ]);

        if($validator->fails()){
            return response()->json([
                "status" => "failed",
                "message" => "failed to update data",
                "data" => $validator->errors()
            ],Response::HTTP_NOT_ACCEPTABLE);
        }

        try{
            $parkir = tb_parkir::findorFail($id);
            $parkir->update([
                'nim' => Str::slug($request->nim),
                'status_masuk' => 0,
                'status_keluar' => 1,
                'created_by' => Str::slug($request->created_by),
                'updated_by' => Str::slug($request->updated_by),
                'hari' => $request->hari,
                'tanggal' => $request->tanggal,
                'jam' => $request->jam
            ]);
            return response()->json([
                'status' => 'success ',
                'message' => 'data updated',
                'data' => $parkir
            ], Response::HTTP_OK);
        }
        catch(\Exception $e){
            return response()->json([
                'status' => 'failed ',
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
