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
            'data_konservasi' => konservasi::all(["id","das", "bt", "ls", "create_in"]),
        );

        return view('beranda', $data);
    }

    public function detail($id)
    {
        $data_konservasi = konservasi::find($id);

        if (!$data_konservasi) {
            abort(404, 'Data not found');
        }

        $data = array(
            'tittle' => 'Detail Lokasi',
            'data' => $data_konservasi
        );

        return view('detail', $data);
    }
}
