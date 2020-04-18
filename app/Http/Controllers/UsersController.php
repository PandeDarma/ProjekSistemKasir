<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use App\Role;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Gate::allows('owner') || Gate::allows('admin')) {
                return $next($request);
            } else {
                return redirect('/kasir');
            }
        });
    }

    public function manageindex(Request $request)
    {


        $user1 = User::all();

        return view('user.manageakun', compact("user1"));
    }

    public function managedelete($id)
    {
        User::destroy($id);
        return redirect('/manageakun')->with('flash', 'Users berhasil di Hapus');
    }
    public function manageregister(Request $request)
    {
        $roles = Role::all();
        return view('user.register', compact('roles'));
    }

    public function managetambah(Request $request)
    {

        $request->validate([
            "name" => "required",
            "alamat" => "required",
            "tahunlahir" => "required",
            "email" => "required|email|unique:users",
            "password1" => "required|same:password2|min:8",
            "password2" => "required|same:password1|min:8"
        ]);
        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password1),
            "role_id" => $request->role,
            "img" => "default.png",
            "alamat" => $request->alamat,
            "ttl" => $request->tahunlahir
        ]);
        return redirect('/manageakun')->with('flash', 'Akun Berhasil Ditambah');
    }

    public function profile(Request $request)
    {

        return view("user.profile");
    }
    public function editprofile(Request $request)
    {
        $userimg = User::where('email', $request->email)->first()->img;

        $request->validate([
            'first_name' => 'required'

        ]);
        if ($request->hasfile('foto')) {

            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            if ($userimg != "default.png") {
                File::delete('assets/foto/' . $userimg);
            }
            $file->move('assets/foto/', $filename);
            $img = $filename;
        } else {
            $img = $userimg;
        }
        User::where('email', $request->email)->update([
            'name' => $request->first_name,
            'img' => $img
        ]);
        return redirect('/profile')->with('flash', "Profile Berhasil Diubah");
    }
}
