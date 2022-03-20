<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Appointments;
use App\models\Doctors;
use App\models\Patients;
use App\models\TimeSlot;
use Validator;
use Auth;

class AppointmentController extends Controller
{

    public function index(){
        $query = Appointments::with('patients','doctors','time_slot');

        if (getUserRole() == 'Doctor') {
            $doctor_id = Doctors::where('user_id', Auth::user()->id)->value('id');
            $query->where('doctor_id', $doctor_id);
        }
        elseif (getUserRole() == 'Patient') {
            $patient_id = Patients::where('user_id', Auth::user()->id)->value('id');
            $query->where('patient_id', $patient_id);
        }

        $appointments = $query->get();

        $doctors    = Doctors::pluck('name','id');
        $patients   = Patients::pluck('name','id');
        $time_slot  = TimeSlot::pluck('time_slot','id');

        return view('appointments/list', compact('appointments', 'doctors', 'patients', 'time_slot'));
    }

    public function store(Request $request){
        $data = $request->all();

        //Back end validation
        $validator = Validator::make($data, [
                'patient'       => 'required',
                'doctor'        => 'required',
                'date'          => 'required',
                'time_slot'     => 'required',
        ]);

        if ($validator->fails()) {
            $return = [];
            $return['status'] = 'error';
            $return['errors'] = $validator->errors();
            
            return $return;
        }
        else{
            //Check doctor's time slot availability
            $check_availablity = Appointments::where('doctor_id',$data['doctor'])->where('date', $data['date'])->where('time_slot_id',$data['time_slot'])->value('id');
            
            if ($check_availablity) {
                $return = [];
                $return['status'] = 'error';
                $return['errors']['time_slot'] = 'The time slot is not available';
                
                return $return;
            }

            $appointment                = new Appointments;
            $appointment->patient_id    = $data['patient'];
            $appointment->doctor_id     = $data['doctor'];
            $appointment->date          = $data['date'];
            $appointment->time_slot_id  = $data['time_slot'];
            $appointment->created_by    = Auth::user()->id;
            $appointment->updated_by    = Auth::user()->id;
            $appointment->save();

            $new_appointment = Appointments::with('patients','doctors')->where('id', $appointment->id)->first();

            return back()->with('success', 'Appointment Created Successfully!');
        }
    }

    public function edit($id){
        $appointment = Appointments::with('time_slot', 'patients', 'doctors')->where('id',$id)->first();
        $time_slot  = TimeSlot::pluck('time_slot','id');
        return view('appointments/update_form', compact('appointment','time_slot'));
    }

    public function update(Request $request){
        $data = $request->all();

        //Back end validation
        $validator = Validator::make($data, [
                'status'        => 'required',
                'date'          => 'required',
                'time_slot'     => 'required',
        ]);

        if ($validator->fails()) {
            $return = [];
            $return['status'] = 'error';
            $return['errors'] = $validator->errors();
            
            return $return;
        }

        else{
            //Check doctor's time slot availability
            $check_availablity = Appointments::where('doctor_id',$data['doctor_id'])->where('date', $data['date'])->where('time_slot_id',$data['time_slot'])->where('id','!=',$data['id'])->value('id');
            
            if ($check_availablity) {
                $return = [];
                $return['status'] = 'error';
                $return['errors']['time_slot'] = 'The time slot is not available';
                
                return $return;
            }

            $appointment                = Appointments::findOrFail($data['id']);
            $appointment->date          = $data['date'];
            $appointment->time_slot_id  = $data['time_slot'];
            $appointment->status        = $data['status'];
            $appointment->created_by    = Auth::user()->id;
            $appointment->updated_by    = Auth::user()->id;
            $appointment->save();

            $new_appointment = Appointments::with('patients','doctors')->where('id', $appointment->id)->first();

            return back()->with('success', 'Appointment Updated Successfully!');
        }
    }
}
