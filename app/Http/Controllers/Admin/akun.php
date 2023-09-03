<?php

namespace App\Http\Controllers\Admin;
use \Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\Validator;
class akun extends Controller
{
    //Global
    public function login(Request $request)
    {
        if (Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            $auth = Auth::user();
            $success['token'] = $auth->createToken('auth_token')->plainTextToken;
            $success['id'] = $auth->id;
            $success['name'] = $auth->name;
            $success['email'] = $auth->email;
            $success['role'] = $auth->role;
            $success['nip_kode'] = $auth->nip_kode;
            $success['alamat'] = $auth->alamat;
            $success['no_telepon'] = $auth->no_telepon;
            return response()->json([
                'success' => true,
                'message'    => 'Login Berhasil',
                'data' =>  $success  
            ], 200);
        }else{
            return response()->json([
                'success' => false,
                'message'    => 'Gagal Login',
                'data' =>  null
            ], 401);
        }
    }
    //REgister Khusus Admin
    public function register(Request $request){
        //set validation
        $validator = Validator::make($request->all(), [
            'nip_kode'      => 'required',
            'name'      => 'required',
            'alamat'      => 'required',
            'no_telepon'      => 'required|string|max:15',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|min:8'
        ]);
        //if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //return response JSON user is created
        $input = $request->all();
        $user = User::create([
            'role' => 1,
            'nip_kode' => $request->nip_kode,
            'name' => $request->name,
            'alamat' => $request->alamat,
            'no_telepon' => $request->no_telepon,
            'email' => $request->email,
            'password' => bcrypt($input['password']),
        ]);
        
        $success['token'] = $user->createToken('auth_token')->plainTextToken;
        $success['name'] = $user->name;
        $success['email'] = $user->email;
        $success['role'] = $user->role;
        $success['nip_kode'] = $user->nip_kode;
        $success['alamat'] = $user->alamat;
        $success['no_telepon'] = $user->no_telepon;
        return response()->json([
            'success' => true,
            'message'    => 'Sukses Register',
            'data' =>  $success  
        ], 200);
        
    }
    //Global
    public function logout(Request $request)
    {
        if($request->user()->currentAccessToken()->delete()){
            return response()->json([
                'success' => true,
                'message' => 'Logout Berhasil',
            ],200);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Logout Gagal',
            ],400);
        }
    }
}
