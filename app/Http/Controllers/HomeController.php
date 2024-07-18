<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\konservasi;

class HomeController extends Controller
{
    public function index()
    {
        $data = array(
            'tittle' => 'Beranda',
            'data_konservasi' => konservasi::all(["bt", "ls", "create_in"]),
        );

        // dd($data['data_konservasi']);

        return view('beranda', $data);
    }
}
