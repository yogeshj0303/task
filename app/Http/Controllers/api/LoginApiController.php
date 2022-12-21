<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
class LoginApiController extends Controller
{  

    public function register(Request $request)
    {
        $checkuser = User::where('email',$request->email)->first();
        if($checkuser->email==$request->email){
            return  response()->json(['error' => true, 'message' => 'User is Already Register']);
        }else{
      $data =new User;
      $data->phone=$request->phone;
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

    public function login(Request $request){
        if($request->email != null) {
            $user = User::where('email', $request->email)->first();
           
           
            if ($user) {
                
                if (!Hash::check($request->input('password'), $user->password)) {
              
                    return response()->json(['error' => true, 'data' => "Password Not metched!"]);
                } else{ 
                    return response()->json(['error' => false, 'result'=>$user, 'data' => "You have successfully login"]);
                }
            }   
             
            
        } else {
            return response()->json(['error' => true, 'data' => 'Null data pass!']);
        }
    }
    public function profile(Request $request){
        $user = User::where('email', $request->email)->first();
        $user->name=$request->firstname;
        $user->last_name=$request->lastname;
        $user->role=$request->role;
        $user->save();
          if($user){
        return  response()->json(['error' => false, 'data' => $user, 'message' => 'Profile is Updated successfully']);
    } else {
        return  response()->json(['error' => true, 'message' => 'Error']);
    }
   }
   public function article(Request $request){
    $user = User::where('email', $request->email)->first();
    if($user->role=="writer"){
        $article = new Article;
        $article->title=$request->title;
    $article->post=$request->post;
    $article->save();
      if($article){
    return  response()->json(['error' => false, 'data' => $article, 'message' => 'Post created successfully']);
} else {
    return  response()->json(['error' => true, 'message' => 'Error']);
}
    }else{
        $article = Article::all();   
        if($article){
            return  response()->json(['error' => false, 'data' => $article]);
        } else {
            return  response()->json(['error' => true, 'message' => 'Error']);
        }
    }
   }
}