<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {    
        $data = array(
            'tittle' => 'Beranda'
        );
           
        return view('beranda', $data);
    }
}
