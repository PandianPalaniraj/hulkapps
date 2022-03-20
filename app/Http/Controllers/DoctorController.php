<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\models\Doctors;
use App\models\Users;
use Validator;
use Auth;

class DoctorController extends Controller
{
    public function index(){
        $doctors = Doctors::with('users')->get();
        return view('doctors/doctors',compact('doctors'));
    }

    public function store(Request $request){
        $data = $request->all();

        //Back end validation
        $validator = validator::make($data, [
                'name'      => 'required|min:3',
                'mobile'    => 'required|numeric|min:10',
                'email'     => 'required|email|unique:users,email',
                'password'  => 'min:6|required_with:password_confirmation|same:password_confirmation',
                'password_confirmation' => 'min:6'
        ]);

        if ($validator->fails()) {
            $return = [];
            $return['status'] = 'error';
            $return['errors'] = $validator->errors();
            
            return $return;
        }

        //User table entries
        $user       = new Users;
        $user->role_id  = 2;
        $user->name     = $data['name'];
        $user->email    = $data['email'];
        $user->password = hash::make($data['password']);
        $user->save();


        //Doctor table enties
        $doctor     = new Doctors;
        $doctor->name   = $data['name'];
        $doctor->mobile = $data['mobile'];
        $doctor->name   = $data['name'];
        $doctor->user_id= $user->id;
        $doctor->created_by = Auth::user()->id;
        $doctor->updated_by = Auth::user()->id;
        $doctor->save();

        return redirect('doctors')->with('success', 'New Doctor Created Successfully!');
    }
}
