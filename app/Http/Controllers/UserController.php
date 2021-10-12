<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
       public $successStatus = 200;


     function register( Request $request)
    {
        $user = new User;
        $user -> name = $request->input('name');
        $user -> email = $request->input('email');
        $user -> password =Hash::make($request->input('password'));
        $user->save();

        return $user;
    }
    function Login(Request $request){
        $user= User::where('email', $request->email)->first();
        if(!$user || !Hash::check($request->password, $user->password)){
            return ['Error'=>"Email Or Password is Not Matched"];
        }
        return $user;

    }
}
