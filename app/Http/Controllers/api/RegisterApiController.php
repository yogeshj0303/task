<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;

use App\Models\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
class RegisterApiController extends Controller
{  

    public function register(Request $request)
    {
        $checkuser = User::where('email',$request->email)->first();
        if($checkuser->email==$request->email){
            return  response()->json(['error' => true, 'message' => 'User is Already Register']);
        }else{
      $data =new User;
      $data->name=$request->name;
      $data->email=$request->email;
      $data->password= Hash::make($request->input('password'));
      $data->password= Hash::make($request->input('confirm_password'));
      $data->save();
      if($data){
        return  response()->json(['error' => false, 'data' => $data, 'message' => 'Register successfully']);
    } else {
        return  response()->json(['error' => true, 'message' => 'Registration Failed']);
    }
        }
    }

}