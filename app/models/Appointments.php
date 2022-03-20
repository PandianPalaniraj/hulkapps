<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointments extends Model
{
    use SoftDeletes;

    protected $table = 'appointment';

    protected $fillable = ['patient_id','doctor_id', 'time_slot_id', 'status', 'created_by', 'updated_by'];

    public function patients(){
        return $this->belongsTo('App\models\Patients','patient_id');
    }

    public function doctors(){
        return $this->belongsTo('App\models\Doctors','doctor_id');
    }

    public function time_slot(){
        return $this->belongsTo('App\models\TimeSlot', 'time_slot_id');
    }
}
