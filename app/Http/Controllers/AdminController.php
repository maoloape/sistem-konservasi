<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\konservasi;

class AdminController extends Controller
{
    public function index()
    {
        $data = array(
            'tittle' => 'Dashboard',
            'data_konservasi' => konservasi::all(),
        );

        return view('admin.dashboard.list', $data);
    }
}
