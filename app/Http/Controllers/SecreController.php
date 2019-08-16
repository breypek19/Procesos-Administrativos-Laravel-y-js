<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SecreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
       $this->middleware('secre');
    }

    


    public function index()
    {
        return view('secretaria.index');
    }
}
