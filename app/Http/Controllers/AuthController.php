<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function index()
    {
        if (Auth::user()) {
            // if ($user->role == 'admin') {
            //     return redirect('laundry/pelanggan');
            // }
            // if ($user->role == 'kasir') {
            //     return redirect('laundry/transaksi');
            // }
            // if ($user->role == 'owner') {
            //     return redirect('laundry/index');
            // }
            return view('index');

        }
        return view('/');
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
            return view('index');
        }
        return redirect('/');
    }

    public function logout()
    {
        session()->flush();
        Auth::logout();

        return redirect('/');
    }
}
