<?php

// For add'active' class for activated route nav-item
function active_class($path, $active = 'active') {
  return call_user_func_array('Request::is', (array)$path) ? $active : '';
}

// For checking activated route
function is_active_route($path) {
  return call_user_func_array('Request::is', (array)$path) ? 'true' : 'false';
}

// For add 'show' class for activated route collapse
function show_class($path) {
  return call_user_func_array('Request::is', (array)$path) ? 'show' : '';
}

function getUserName(){
  if (isset(Auth::user()->id)) {
      return Auth::user()->name;
  }
}

function getUserRole(){
  if (isset(Auth::user()->id)) {

      $role = App\models\Roles::where('id', Auth::user()->role_id)->value('role');

      return $role;
  }
}

function getPatientId(){
  if (isset(Auth::user()->id)) {
    $patient_id = App\models\Patients::where('user_id', Auth::user()->id)->value('id');
    return $patient_id;
  }
}

function getModuleName(){
  $current_url = url()->current();

  $explode_url = explode('/', $current_url);

  if (in_array('patients', $explode_url)) {
    return 'patient';
  }
  elseif (in_array('doctors', $explode_url)) {
    return 'doctor';
  }
  else{
    return 'appointment';
  }
}