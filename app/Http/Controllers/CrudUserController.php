<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CrudUserController extends Controller
{
    public function index()
    {
        $data = array(
            'tittle' => 'Data User',
            'data_user' => User::all(),
        );

        return view('admin.user.list',$data);
    }

    // setting profile
    public function profile()
    {
        $user = Auth::user()->id;

        $data = array(
            'title' => 'Setting Profile',
            'data_profile' => User::where('id', $user)->get(),
        );

        return view('profile',$data);
    }

    public function store(Request $request)
    {   
        $request->validate([
            'email' => 'required',
            'password' => 'required|max:6',
        ]);
        
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect('/User-Account')->with('Success', 'Data Berhasil Disimpan');
    }

    public function update(Request $request, $id)
    {   
        $request->validate([
            'email' => 'required',
            'password' => 'required|max:6',
        ]);

        User::where('id', $id)
        ->where('id', $id)
        ->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect('/User-Account')->with('Success', 'Data Berhasil Disimpan');
        
    }

    // setting profile
    public function updateprofile(Request $request, $id)
    {      
        $request->validate([
            'email' => 'required',
            'password' => 'required|max:6',
        ]);
        
        User::where('id', $id)
        ->where('id', $id)
        ->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect('/profile')->with('Success', 'Data Berhasil Disimpan');
    }

    public function destroy($id)
    {
        user::where('id', $id)->delete();
        return redirect('/User-Account')->with('Success', 'Data Berhasil Dihapus');
    }
}
