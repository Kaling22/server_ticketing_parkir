<?php

namespace App\Http\Controllers\Admin;
use \Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\Validator;
class data_staff extends Controller
{
    //done
    public function login(Request $request)
    {
        if (Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            $auth = Auth::user();
            $success['token'] = $auth->createToken('auth_token')->plainTextToken;
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
    //done
    public function register(Request $request){
        //set validation
        $validator = Validator::make($request->all(), [
            'role'      => 'required|integer|digits:1',
            'nip_kode'      => 'required',
            'name'      => 'required',
            'alamat'      => 'required',
            'no_telepon'      => 'required|integer|max:15',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|min:8'
        ]);
        //if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //return response JSON user is created
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        
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
    //done
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
