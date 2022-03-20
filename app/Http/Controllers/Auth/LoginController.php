<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Validator;
use Auth;

class LoginController extends Controller
{
  
    public function index(){
        return view('auth/login');
    }

    public function checkLogin(Request $request){
        $data = $request->all();

        $validator = Validator::make($data, [
            'email'     => 'required|email',
            'password'  => 'required|min:3'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }

        $user_data = array(
            'email'     => $data['email'],
            'password'  => $data['password']
        );

        if (Auth::attempt($user_data)) {
            return redirect('/appointments');
        }else{
            return back()->with('error', 'Invalid Credentials!');
        }
    }

    public function logout(){
        
        Auth::logout();

        return redirect('/login');
    }
}
