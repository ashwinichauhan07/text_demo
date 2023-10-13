<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalenderController extends Controller
{
    public function viewCalendar()
    {
    	return view('admin.calender');
    	return view('instructortadmin.calender');
    	return view('instituteadmin.calender');
    }
}
