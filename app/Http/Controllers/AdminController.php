<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {    
        $data = array(
            'tittle' => 'Beranda'
        );
           
        return view('home', $data);
    }
}
