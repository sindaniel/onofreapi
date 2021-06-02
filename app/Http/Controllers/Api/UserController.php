<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;



class UserController extends Controller
{
    

    public function login(Request $request){

        $username = $request->username;
        $password = $request->password;


        $user = User::whereEmail($username)->first();

        $data = ['user'=>false];
        if($user){
            $data = ['user'=>true];
        }


        return $data;
    
    }


    public function create(Request $request){
      
        $username = $request->username;
        $name = $request->name;
        $password =  Hash::make($request->password);


        $user = User::whereEmail($username)->first();
        if($user){
            $data = ['user'=>false, 'message'=>'Usuario ya existe'];
            return $data;
        }


        $user = User::create([
            'email' =>$username,
            'name' =>$name,
            'password' =>$password,
        ]);

        $data = ['user'=>true];
      


        return $data;
    
    }


}
