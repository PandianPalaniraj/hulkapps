<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\models\Patients;
use App\models\Users;
use Validator;
use Auth;

class PatientController extends Controller
{
    public function index(){
        $patients = Patients::with('users')->get();

        return view('patients/patients',compact('patients'));
    }

    
    public function store(Request $request){
        $data = $request->all();

        //Back end validation
        $validator = validator::make($data, [
                'name'      => 'required|min:3',
                'mobile'    => 'required|numeric|min:10',
                'email'     => 'required|email|unique:users,email',
                'password'  => 'min:6|required_with:password_confirmation|same:password_confirmation',
                'password_confirmation' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            $return = [];
            $return['status'] = 'error';
            $return['errors'] = $validator->errors();
            
            return $return;
        }

        //User table entries
        $user       = new Users;
        $user->role_id  = 3;
        $user->name     = $data['name'];
        $user->email    = $data['email'];
        $user->password = hash::make($data['password']);
        $user->save();


        //Patient table enties
        $patient     = new Patients;
        $patient->name   = $data['name'];
        $patient->mobile = $data['mobile'];
        $patient->name   = $data['name'];
        $patient->user_id= $user->id;
        $patient->created_by = Auth::user()->id;
        $patient->updated_by = Auth::user()->id;
        $patient->save();

        return back()->with('success', 'New Patient Created Successfully!');
    }
}
