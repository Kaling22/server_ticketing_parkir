<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tb_parkir;
use App\Models\tb_mahasiswa;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
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
        ], 200);
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
        ]);

        if($validator->fails()){
            return response()->json([
                "status" => "failed",
                "message" => "failed to create new data parkir",
                "data" => $validator->errors()
            ],Response::HTTP_NOT_ACCEPTABLE);
        }

        if ($request->nim==null) {
            $z=null;
        }else {
            $z=Str::slug($request->nim);
        }

        if ($request->nfc_num==null) {
            $x=null;
        }else {
            $x=Str::slug($request->nfc_num);
        }

        if ($request->nfc_num_ktp==null) {
            $y=null;
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
            ], 200);
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

            $plat = tb_mahasiswa::query()->select('kendaraan')
            ->orWhere('nim', $para)->orWhere('nfc_num',$para)->orWhere('nfc_num_ktp',$para)->latest('created_at')->first();

            $explode_id = explode(',', $plat->kendaraan);
            $data_mahasiswa = array_merge($explode_id);

            $data_parkir = tb_parkir::query()
                ->with(['mahasiswa' => function ($query) {
                $query->select('nim','name','jurusan','fakultas','nfc_num','nfc_num_ktp','angkatan','foto','kendaraan');
                }])->orWhere('nim', $para)->orWhere('nfc_num',$para)->orWhere('nfc_num_ktp',$para)->latest('created_at')->first();
            
            $data_parkir['kendaraan'] = $explode_id;
            return response()->json([
                'success' => true,
                'message' => 'showing data mahasiswa',
                'data' => $data_parkir
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $para)
    {
        try{
            $parkir = tb_parkir::query()
                ->with(['mahasiswa' => function ($query) {
                $query->select('nim','name','jurusan','fakultas','nfc_num','nfc_num_ktp','angkatan','foto');
                }])->where('nim', $para)->orWhere('nfc_num',$para)->orWhere('nfc_num_ktp',$para)->latest('created_at')->first();
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
            ], 200);
        }
        catch(\Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'product not found',
                'data'=> $e->getMessage()
            ], Response::HTTP_NOT_FOUND);
        }
    }

}
