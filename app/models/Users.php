<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Users extends Model
{
    use SoftDeletes;

    protected $table = 'users';

    protected $fillable = ['role_id', 'name', 'email', 'password'];


    public function roles(){
        return $this->belongsTo('App\models\roles','role_id');
    }
}
