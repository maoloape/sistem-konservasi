<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\konservasi;
use App\Models\Image;

class MasterController extends Controller
{
    public function index()
    {
        $data = [
            'tittle' => 'Master Data',
            'data_konservasi' => konservasi::with('images')->get(),
        ];

        return view('admin.master.list', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'bt' => 'required',
            'ls' => 'required',
            'dokumentasi.*' => 'mimes:png,jpg,jpeg|max:2048', // Validate each file
        ],[
            'dokumentasi.*.mimes' => 'Dokumentasi harus berupa file png, jpg, atau jpeg',
            'dokumentasi.*.max' => 'Dokumentasi tidak boleh lebih dari 2MB per file',
        ]);

        if (strpos($request->bt, ',') !== false || strpos($request->ls, ',') !== false) {
            return back()->withErrors([
                'bt' => 'Format koordinat LS tidak boleh mengandung koma.',
                'ls' => 'Format koordinat BT tidak boleh mengandung koma.'
            ])->withInput()->with('modal', 'create');
        }

        $konservasi = konservasi::create([
            'das'           => $request->das,
            'sub_das'       => $request->sub_das,
            'kecamatan'     => $request->kecamatan,
            'desa'          => $request->desa,
            'bt'            => $request->bt,
            'ls'            => $request->ls,
            'jenis_batu'    => $request->jenis_batu,
            'keterangan'    => $request->keterangan,
            'create_in'     => 'in',
        ]);

        if ($request->hasFile('dokumentasi')) {
            $files = $request->file('dokumentasi');
            foreach ($files as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads'), $filename);
                Image::create([
                    'konservasi_id' => $konservasi->id,
                    'filename' => $filename,
                ]);
            }
        }

        return redirect('/konservasi-data')->with('Success', 'Data Berhasil Disimpan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'bt' => 'required',
            'ls' => 'required',
            'dokumentasi.*' => 'mimes:png,jpg,jpeg|max:2048',
        ],[
            'dokumentasi.*.mimes' => 'Dokumentasi harus berupa file png, jpg, atau jpeg',
            'dokumentasi.*.max' => 'Dokumentasi tidak boleh lebih dari 2MB per file',
        ]);

        if (strpos($request->bt, ',') !== false || strpos($request->ls, ',') !== false) {
            return back()->withErrors([
                'bt' => 'Format koordinat LS tidak boleh mengandung koma.',
                'ls' => 'Format koordinat BT tidak boleh mengandung koma.'
            ])->withInput()->with('modal', 'edit');
        }

        $konservasi = konservasi::findOrFail($id);

        $konservasi->update([
            'das'           => $request->das,
            'sub_das'       => $request->sub_das,
            'kecamatan'     => $request->kecamatan,
            'desa'          => $request->desa,
            'bt'            => $request->bt,
            'ls'            => $request->ls,
            'jenis_batu'    => $request->jenis_batu,
            'keterangan'    => $request->keterangan,
        ]);

        if ($request->hasFile('dokumentasi')) {
            $files = $request->file('dokumentasi');
            foreach ($files as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads'), $filename);
                Image::create([
                    'konservasi_id' => $konservasi->id,
                    'filename' => $filename,
                ]);
            }
        }

        return redirect('/konservasi-data')->with('success', 'Data Berhasil Diperbarui');
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'bt' => 'required|numeric',
    //         'ls' => 'required|numeric',
    //         'dokumentasi.*' => 'mimes:png,jpg,jpeg|max:2048', // Validate each file
    //     ],[
    //         'dokumentasi.*.mimes' => 'Dokumentasi harus berupa file png, jpg, atau jpeg',
    //         'dokumentasi.*.max' => 'Dokumentasi tidak boleh lebih dari 2MB per file',
    //     ]);

    //     if (strpos($request->bt, ',') !== false || strpos($request->ls, ',') !== false) {
    //         return back()->withErrors([
    //             'bt' => 'Format koordinat tidak boleh mengandung koma.',
    //             'ls' => 'Format koordinat tidak boleh mengandung koma.'
    //         ])->withInput()->with('modal', 'create');
    //     }

    //     $konservasi = konservasi::create([
    //         'das'           => $request->das,
    //         'sub_das'       => $request->sub_das,
    //         'kecamatan'     => $request->kecamatan,
    //         'desa'          => $request->desa,
    //         'bt'            => $request->bt,
    //         'ls'            => $request->ls,
    //         'jenis_batu'    => $request->jenis_batu,
    //         'keterangan'    => $request->keterangan,
    //         'create_in'     => 'in',
    //     ]);

    //     if ($request->hasFile('dokumentasi')) {
    //         $files = $request->file('dokumentasi');
    //         foreach ($files as $file) {
    //             $filename = time() . '_' . $file->getClientOriginalName();
    //             $file->move(public_path('uploads'), $filename);
    //             Image::create([
    //                 'konservasi_id' => $konservasi->id,
    //                 'filename' => $filename,
    //             ]);
    //         }
    //     }

    //     return redirect('/konservasi-data')->with('Success', 'Data Berhasil Disimpan');
    // }

    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'bt' => 'required',
    //         'ls' => 'required',
    //         'dokumentasi.*' => 'mimes:png,jpg,jpeg|max:2048',
    //     ],[
    //         'dokumentasi.*.mimes' => 'Dokumentasi harus berupa file png, jpg, atau jpeg',
    //         'dokumentasi.*.max' => 'Dokumentasi tidak boleh lebih dari 2MB per file',
    //     ]);

    //     if (strpos($request->bt, ',') !== false || strpos($request->ls, ',') !== false) {
    //         return back()->withErrors([
    //             'bt' => 'Format koordinat tidak boleh mengandung koma.',
    //             'ls' => 'Format koordinat tidak boleh mengandung koma.'
    //         ])->withInput()->with('modal', 'edit');
    //     } else {
    //         $konservasi = konservasi::findOrFail($id);

    //         $konservasi->update([
    //             'das'           => $request->das,
    //             'sub_das'       => $request->sub_das,
    //             'kecamatan'     => $request->kecamatan,
    //             'desa'          => $request->desa,
    //             'bt'            => $request->bt,
    //             'ls'            => $request->ls,
    //             'jenis_batu'    => $request->jenis_batu,
    //             'keterangan'    => $request->keterangan,
    //         ]);

    //         if ($request->hasFile('dokumentasi')) {
    //             $files = $request->file('dokumentasi');
    //             foreach ($files as $file) {
    //                 $filename = time() . '_' . $file->getClientOriginalName();
    //                 $file->move(public_path('uploads'), $filename);
    //                 Image::create([
    //                     'konservasi_id' => $konservasi->id,
    //                     'filename' => $filename,
    //                 ]);
    //             }
    //         }

    //             return redirect('/konservasi-data')->with('success', 'Data Berhasil Diperbarui');
    //         }

    //     // $konservasi = konservasi::findOrFail($id);

    //     // $konservasi->update([
    //     //     'das'           => $request->das,
    //     //     'sub_das'       => $request->sub_das,
    //     //     'kabupaten'     => $request->kabupaten,
    //     //     'kecamatan'     => $request->kecamatan,
    //     //     'desa'          => $request->desa,
    //     //     'blok'          => $request->blok,
    //     //     'bt'            => $request->bt,
    //     //     'ls'            => $request->ls,
    //     //     'jenis_batu'    => $request->jenis_batu,
    //     //     'keterangan'    => $request->keterangan,
    //     // ]);

    //     // if ($request->hasFile('dokumentasi')) {
    //     //     $files = $request->file('dokumentasi');
    //     //     foreach ($files as $file) {
    //     //         $filename = time() . '_' . $file->getClientOriginalName();
    //     //         $file->move(public_path('uploads'), $filename);
    //     //         Image::create([
    //     //             'konservasi_id' => $konservasi->id,
    //     //             'filename' => $filename,
    //     //         ]);
    //     //     }
    //     // }

    //     // return redirect('/konservasi-data')->with('Success', 'Data Berhasil Diperbarui');
    // }

    public function deleteGalleryImage(Request $request)
    {
        $image_id = $request->input('image_id');
        $gallery_image = Image::find($image_id);
        if ($gallery_image) {
            $gallery_image->delete();
            return back()->with('success', 'Image deleted successfully');
        } else {
            return back()->with('error', 'Image not found');
        }
    }

    public function destroy($id)
    {
        $konservasi = konservasi::findOrFail($id);

        foreach ($konservasi->images as $image) {
            $filePath = public_path('uploads') . '/' . $image->filename;
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            $image->delete();
        }

        $konservasi->delete();

        return redirect('/konservasi-data')->with('Success', 'Data Berhasil Dihapus');
    }
}
