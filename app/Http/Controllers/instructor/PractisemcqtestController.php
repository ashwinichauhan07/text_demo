<?php

namespace App\Http\Controllers;

use App\Models\McqBank;
use App\Models\Mcqtype;
use App\Models\Practisemcq;
use App\Models\Question;
use App\Models\Subject;
use Illuminate\Http\Request;

class PractisemcqtestController extends Controller
{
	public function index(){
		

	    return view('practise_mcqtestpaper.index');
	}

}
