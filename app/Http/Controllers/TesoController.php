<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TesoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
       $this->middleware('teso');
    }

    


    public function index()
    {
        return view('tesoreria.index');
    }
}
