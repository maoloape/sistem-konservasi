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
        // Ambil data konservasi berdasarkan ID
        $data_detail = konservasi::with('images')->find($id);

        if (!$data_detail) {
            abort(404, 'Data not found');
        }

        // Ambil gambar berdasarkan ID konservasi
        $images = $data_detail->images;

        $data = array(
            'tittle' => 'Detail Lokasi',
            'data1' => $data_detail,
            'images' => $images,
        );

        return view('detail', $data);
    }

}
