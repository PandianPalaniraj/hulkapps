<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patients extends Model
{
    use SoftDeletes;

    protected $table = 'patients';

    protected $fillable = ['user_id','name','created_by', 'updated_by'];

    public function users(){
        return $this->belongsTo('App\models\Users', 'user_id');
    }
}
