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
            'das'           => $request->das,
            'sub_das'       => $request->sub_das,
            'kabupaten'     => $request->kabupaten,
            'kecamatan'     => $request->kecamatan,
            'desa'          => $request->desa,
            'blok'          => $request->blok,
            'bt'            => $request->bt,
            'ls'            => $request->ls,
            'dokumentasi'   => $filename,
            'updated_at'    => now(),
            'created_at'    => now(),
            'create_in'     => 'in',
            'jenis_batu'    => $request->jenis_batu,
            'keterangan'    => $request->keterangan,
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
            'keterangan'    => $request->keterangan,
            'dokumentasi'   => $filename,
        ]);

        return redirect('/konservasi-data')->with('Success', 'Data Berhasil Disimpan');

    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'dokumentasi' => 'mimes:png,jpg,jpeg|max:2048',
    //         'dokumentasi.*' => 'mimes:png,jpg,jpeg|max:2048', // Add this line to validate multiple files
    //     ],[
    //         'dokumentasi.mimes' => 'Dokumentasi harus berupa file png, jpg, atau jpeg',
    //         'dokumentasi.max' => 'Dokumentasi tidak boleh lebih dari 2MB',
    //     ]);

    //     $filenames = []; // Initialize an array to store the uploaded file names

    //     if ($request->hasFile('dokumentasi')) {
    //         $files = $request->file('dokumentasi'); // Get the uploaded files
    //         foreach ($files as $file) {
    //             $filename = time() . '_' . $file->getClientOriginalName();
    //             $file->move(public_path('uploads'), $filename);
    //             $filenames[] = $filename; // Add the uploaded file name to the array
    //         }
    //     } else {
    //         $filenames = null;
    //     }

    //     konservasi::create([
    //         'das'           => $request->das,
    //         'sub_das'       => $request->sub_das,
    //         'kabupaten'     => $request->kabupaten,
    //         'kecamatan'     => $request->kecamatan,
    //         'desa'          => $request->desa,
    //         'blok'          => $request->blok,
    //         'bt'            => $request->bt,
    //         'ls'            => $request->ls,
    //         'dokumentasi'   => json_encode($filenames), // Store the array of file names as a JSON string
    //         'updated_at'    => now(),
    //         'created_at'    => now(),
    //         'create_in'     => 'in',
    //         'jenis_batu'    => $request->jenis_batu,
    //         'keterangan'    => $request->keterangan,
    //     ]);

    //     return redirect('/konservasi-data')->with('Success', 'Data Berhasil Disimpan');
    // }

    // public function update(Request $request, $id)
    // {
    //     // Validasi input
    //     $request->validate([
    //         'dokumentasi' => 'mimes:png,jpg,jpeg|max:2048',
    //     ],[
    //         'dokumentasi.mimes' => 'Dokumentasi harus berupa file png, jpg, atau jpeg',
    //         'dokumentasi.max' => 'Dokumentasi tidak boleh lebih dari 2MB',
    //     ]);

    //     $konservasi = konservasi::findOrFail($id);

    //     $filenames = json_decode($konservasi->dokumentasi, true); // Get the existing file names from the database

    //     if ($request->hasFile('dokumentasi')) {
    //         $files = $request->file('dokumentasi');
    //         foreach ($files as $file) {
    //             $filename = time() . '_' . $file->getClientOriginalName();
    //             $file->move(public_path('uploads'), $filename);
    //             $filenames[] = $filename; // Add the new file name to the array
    //         }
    //     }

    //     // Remove old files if they exist
    //     foreach ($konservasi->dokumentasi as $oldFile) {
    //         $oldFilePath = public_path('uploads') . '/' . $oldFile;
    //         if (file_exists($oldFilePath)) {
    //             unlink($oldFilePath);
    //         }
    //     }

    //     konservasi::where('id', $id)
    //     ->update([
    //         'das'           => $request->das,
    //         'sub_das'       => $request->sub_das,
    //         'kabupaten'     => $request->kabupaten,
    //         'kecamatan'     => $request->kecamatan,
    //         'desa'          => $request->desa,
    //         'blok'          => $request->blok,
    //         'bt'            => $request->bt,
    //         'ls'            => $request->ls,
    //         'jenis_batu'    => $request->jenis_batu,
    //         'keterangan'    => $request->keterangan,
    //         'dokumentasi'   => json_encode($filenames), // Update the array of file names
    //     ]);

    //     return redirect('/konservasi-data')->with('Success', 'Data Berhasil Disimpan');

    // }

    public function destroy($id)
    {
        konservasi::where('id', $id)->delete();
        return redirect('/konservasi-data')->with('Success', 'Data Berhasil Dihapus');
    }
}
