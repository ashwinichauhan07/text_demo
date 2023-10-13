<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

   class HomeController extends Controller
{
    public function home()
    {
        return view('auth.login');
    }

    public function contact()
    {
        return view('home.contact');
    }

    public function term()
    {
        return view('home.term');
    }

    public function about()
    {
        return view('home.about');
    }
}
