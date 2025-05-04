<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    
    public function home()
    {
        return view('home');
    }

    public function festivals()
    {
        return view('festivals');
    }

    public function map()
    {
        return view('map');
    }
    public function calendar()
    {
        return view('calendar');
    }
    public function contact()
    {
        return view('contact');
    }


    public function create()
    {
        return view('festivals.create');
    } 
}