<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Appointments;

class DashboardController extends Controller
{
    public function index() {

        $appointments = Appointments::with('patients', 'doctors')->get();

        return view('dashboard');
    }
}
