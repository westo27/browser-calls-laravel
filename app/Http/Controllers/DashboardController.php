<?php

namespace App\Http\Controllers;

use App\Http\Requests;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('supportDashboard');
    }
}
