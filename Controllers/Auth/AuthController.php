<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\LoginRequest;
use App\User;


class AuthController extends Controller
{
    public function register(Request $request){

        //$input =$request->all();
        //User::insert($input);

        return ($user = User::create([
            'name' => $request -> get('name'),
            'email' => $request-> get('email'),
            'password'=> Hash::make($request->get('password')),
        ]));


    }

    public function login(LoginRequest $request){
        
        // $credentials = $request->only('email', 'password');

        // if (Auth::attempt($credentials)) {
        //     // Authentication passed...
        //     return redirect()->intended('dashboard');
            
        // }

        $email = $request -> get('email');
        $password = $request -> get('password');
        $user = User :: where(['email'=> $email])->first();
        // dd($user);

        if(Hash::check($password, $user->password)){
            
            if($user){
                return response()->json(['status' => 'success','user'=>$user], 200);   
            }

        } else {
            return response()->json(['status' => 'unsuccess' ,'error' => 'username or password incorrect'], 200);
        }


    }
    
}
