<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\Validator;

class data_staff extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staff = User::where('role',2)->get();
        return view('admin.Menus.DataStaff.data-staff',compact('staff'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.Menus.DataStaff.create-data-staff');
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
            //'role'      => 2,
            'nip_kode'      => 'required',
            'name'      => 'required',
            'alamat'      => 'required',
            'no_telepon'      => 'required|integer|max:15',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|min:8'
        ]);

        
        $input = $request->all();
        $user = User::create([
            'role' => 2,
            'nip_kode' => $request->nip_kode,
            'name' => $request->name,
            'alamat' => $request->alamat,
            'no_telepon' => $request->no_telepon,
            'email' => $request->email,
            'password' => bcrypt($input['password']),
            ]);
        $success['token'] = $user->createToken('auth_token')->plainTextToken;

        return redirect()->route('dataStaff.index');
    }
}
