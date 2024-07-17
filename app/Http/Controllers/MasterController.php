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
        $request->validate([
            'dokumentasi' => 'mimes:png,jpg,jpeg|max:2048',
        ],[
            'dokumentasi.mimes' => 'Dokumentasi harus berupa file png, jpg, atau jpeg',
            'dokumentasi.max' => 'Dokumentasi tidak boleh lebih dari 2MB',
        ]);
    
        // Upload the file if it exists
        if ($request->hasFile('dokumentasi')) {
            $file = $request->file('dokumentasi');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
        } else {
            $filename = null;
        }

        konservasi::create([
            'das' => $request->das,
            'sub_das' => $request->sub_das,
            'kabupaten' => $request->kabupaten,
            'kecamatan' => $request->kecamatan,
            'desa' => $request->desa,
            'blok' => $request->blok,
            'bt' => $request->bt,
            'ls' => $request->ls,
            'dokumentasi' => $filename,
            'updated_at' => now(),
            'created_at' => now(),
            'jenis_batu' => $request->jenis_batu ?? 'default_value', // Pastikan baris ini ditambahkan
        ]);

        return redirect('/konservasi-data')->with('Success', 'Data Berhasil Disimpan');
    }

    public function update(Request $request, $id)
    {   
        // Validasi input
        $request->validate([
            'dokumentasi' => 'mimes:png,jpg,jpeg|max:2048',
        ],[
            'dokumentasi.mimes' => 'Dokumentasi harus berupa file png, jpg, atau jpeg',
            'dokumentasi.max' => 'Dokumentasi tidak boleh lebih dari 2MB',
        ]);

        $konservasi = konservasi::findOrFail($id);

        // Upload file jika ada
        if ($request->hasFile('dokumentasi')) {
            $file = $request->file('dokumentasi');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);

            // Hapus file lama jika ada
            if ($konservasi->dokumentasi) {
                $oldFile = public_path('uploads') . '/' . $konservasi->dokumentasi;
                if (file_exists($oldFile)) {
                    unlink($oldFile);
                }
            }
        } else {
            $filename = $konservasi->dokumentasi; // Gunakan filename lama jika tidak ada file baru yang di-upload
        }

        konservasi::where('id', $id)
        ->where('id', $id)
        ->update([
            'das'           => $request->das,
            'sub_das'       => $request->sub_das,
            'kabupaten'     => $request->kabupaten,
            'kecamatan'     => $request->kecamatan,
            'desa'          => $request->desa,
            'blok'          => $request->blok,
            'bt'            => $request->bt,
            'ls'            => $request->ls,
            'jenis_batu'    => $request->jenis_batu,
            'dokumentasi'   => $filename->dokumentasi,
        ]);

        return redirect('/konservasi-data')->with('Success', 'Data Berhasil Disimpan');
        
    }

    public function destroy($id)
    {
        konservasi::where('id', $id)->delete();
        return redirect('/konservasi-data')->with('Success', 'Data Berhasil Dihapus');
    }
}
