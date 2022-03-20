<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('login', 'Auth\LoginController@index')->name('login');
Route::post('login', 'Auth\LoginController@checkLogin')->name('login-check');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

// Routes resticted with custom authentication middleware
Route::group(['middleware' => 'CustomAuth'], function(){
    Route::get('/', 'AppointmentController@index');

    Route::group(['middleware' => 'CheckAdmin'], function(){
        //Routes for doctor module
        Route::group(['prefix' => 'doctors'], function(){
            Route::get('/', 'DoctorController@index');
            Route::post('/', 'DoctorController@store')->name('Create-Doctor');
        }); 

        //Routes for patient module
        Route::group(['prefix' => 'patients'], function(){
            Route::get('/', 'PatientController@index');
            Route::post('/', 'PatientController@store')->name('Create-Patient');
        });
    });

    //Routes for appointment module
    Route::group(['prefix' => 'appointments'], function(){
        Route::get('/', 'AppointmentController@index');
        Route::post('/', 'AppointmentController@store')->name('Create-Appointment');
        Route::get('/edit/{id}', 'AppointmentController@edit');
        Route::post('/update', 'AppointmentController@update')->name('Update-Appointment');
    }); 

});

