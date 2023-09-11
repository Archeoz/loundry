<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Outlet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use PHPUnit\Framework\MockObject\Stub\ReturnStub;

class UserController extends Controller
{
    public function tampil()
    {
        $user = User::join('outlets','users.id_outlet','=','outlets.id_outlet')
        // ->select(['outlets.*','users.nama','users.username','users.role','users.email','users.id',])->get();
        ->select(['outlets.*','users.*'])->get();


        return view('user.data',compact('user'));
    }

    public function registerpage()
    {
        $outlet = Outlet::all();
        return view('user.register',compact('outlet'));
    }

    public function registeruser(Request $request)
    {
        $data = $request->validate([
            'outlet' => 'required',
            'nama' => 'required',
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required',
        ]);

        User::create([
            'id_outlet'=>$data['outlet'],
            'nama'=>$data['nama'],
            'username'=>$data['username'],
            'email'=>$data['email'],
            'role'=>$data['role'],
            'password'=>$data['password'],
            // 'password'=>bcrypt($data['password']),
            // 'password'=>Hash::make($data['password']),
        ]);

        return redirect('laundry/user');
    }

    public function updatepage($id)
    {
        $outlet = Outlet::all();
        $user = User::where('id', $id)->first();
        return view('user.edit',compact('user','outlet'));
    }

    public function update(Request $request, $id)
    {
        if (isset($request->password)) {
            $data = $request->validate([
                'id_outlet' => 'required',
                'nama' =>'required',
                'username' => 'required',
                'email' => 'required',
                'role' => 'required',
                'password' => 'required',
            ]);

            User::where('id',$id)->update([
                'id_outlet' => $data['outlet'],
                'nama' => $data['nama'],
                'username' => $data['username'],
                'email' => $data['email'],
                'role' => $data['role'],
                'password' => $data[bcrypt('password')],
                // 'password' => $data[Hash::make('password')],
            ]);
        } else {
            $data = $request->validate([
                'id_outlet' => 'required',
                'nama' =>'required',
                'username' => 'required',
                'email' => 'required',
                'role' => 'required',
            ]);
            User::where('id',$id)->update([
                'id_outlet' => $data['outlet'],
                'nama' => $data['nama'],
                'username' => $data['username'],
                'email' => $data['email'],
                'role' => $data['role'],
            ]);
        }

        return redirect('laundry/user');
    }

    public function delete($id)
    {
        // dd($id);
       $user = User::where('id',$id)->get();
       $role = User::where('role',$user[0]['role']);
       $count = $role->count();

        if ($count == 1) {
            session()->flash('pesan', 'Data Hanya Ada Satu, Tidak Bisa Dihapus');
        } else {
            User::where('id',$id)->delete();
        }


        return redirect('laundry/user');
    }
}
