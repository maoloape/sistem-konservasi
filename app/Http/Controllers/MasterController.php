<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\konservasi;

class MasterController extends Controller
{
    public function index()
    {    
        $data = array(
            'tittle' => 'Master Data',
            'data_konservasi' => konservasi::all(),
        );
           
        return view('admin.master.list', $data);
    }

    public function store(Request $request)
    {
        konservasi::create([
            'das'           => $request->das,
            'sub_das'       => $request->sub_das,
            'kabupaten'     => $request->kabupaten,
            'kecamatan'     => $request->kecamatan,
            'desa'          => $request->desa,
            'blok'          => $request->blok,
            'bt'            => $request->bt,
            'ls'            => $request->ls,
            'dokumentasi'   => $request->dokumentasi,
            // 'jenis_batu'   => $request->jenis_batu,
        ]);

        return redirect('/konservasi-data')->with('Success', 'Data Berhasil Disimpan');
    }

    public function update(Request $request, $id)
    {
        konservasi::where('id', $id)
        ->where('id', $id)
        ->update([
            'nama_barang'   => $request->nama_barang,
            'type'          => $request->type,
            'serial_no'     => $request->serial_no,
            'no_produk'     => $request->no_produk,
            'no_kontrak'    => $request->no_kontrak,
        ]);

        return redirect('/konservasi-data')->with('Success', 'Data Berhasil Disimpan');
        
    }

    public function destroy($id)
    {
        konservasi::where('id', $id)->delete();
        return redirect('/konservasi-data')->with('Success', 'Data Berhasil Dihapus');
    }
}
