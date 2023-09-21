<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{

    public function index()
    {
        // $username = Auth::user()->username;
        // if (Auth::user()) {
            // if ($user->role == 'admin') {
            //     return redirect('laundry/pelanggan');
            // }
            // if ($user->role == 'kasir') {
            //     return redirect('laundry/transaksi');
            // }
            // if ($user->role == 'owner') {
            //     return redirect('laundry/index');
            // }
            // Alert::success('Berhasil Login', 'Selamat Datang,');
            // alert()->success('Title','Lorem Lorem Lorem');
            // return redirect('index');

        // }
        // return redirect('/');
    }

    public function postlogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $data = $request->only('email','password');

        if (Auth::attempt($data)) {
            // $user = Auth::user();
            // if ($user->role == 'admin') {
            //     return redirect('laundry/pelanggan');
            // }
            // if ($user->role == 'kasir') {
            //     return redirect('laundry/transaksi');
            // }
            // if ($user->role == 'owner') {
            //     return redirect('laundry/index');
            // }
            Alert::success('Berhasil Login', 'Selamat Datang');
            return view('index');
        }
        // if (!Auth::attempt($data['email'])) {
        //     Alert::warning('Login Gagal', 'Email Salah');
        //     return redirect('/');

        // }elseif(!Auth::attempt($data['password'])){
        //     Alert::warning('Login Gagal', 'Password Salah');
        //     return redirect('/');
        // }
        return redirect('/');
    }

    public function logout()
    {
        session()->flush();
        Auth::logout();

        return redirect('/');
    }
}
