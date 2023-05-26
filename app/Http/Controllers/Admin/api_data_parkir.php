<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\tb_parkir;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ParkirResource;
class api_data_parkir extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resource_parkir = ParkirResource::collection(tb_parkir::all());
        return response()->json([
            'status' => 'success ',
            'message' => 'showing all parkir',
            'data' => $resource_parkir
        ], Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
            'nim' => 'required|string',
            'status_masuk' => 'required|string',
            'status_keluar' => 'required|string',
            'created_by' => 'required|string',
            'updated_by' => 'required|string',
            'date' => 'required|string',
        ]);

        if($validator->fails()){
            return response()->json([
                "status" => "failed",
                "message" => "failed to create new data parkir",
                "data" => $validator->errors()
            ],Response::HTTP_NOT_ACCEPTABLE);
        }

        $resource_parkir = new ParkirResource(tb_parkir::create($request->all()));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
