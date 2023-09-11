<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $member = Member::all();
        return view('pelanggan.data',compact('member'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'jeniskelamin' => 'required',
            'telp' => 'required',
        ]);

        Member::create([
            'nama_member' => $data['nama'],
            'alamat' => $data['alamat'],
            'jeniskelamin' => $data['jeniskelamin'],
            'telp' => $data['telp'],
        ]);

        return redirect('laundry/pelanggan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    public function updatemember($id_member)
    {
        $member = Member::where('id_member',$id_member)->first();
        return view('pelanggan.edit',compact('member'));
    }

    public function update(Request $request, $id_member)
    {

        Member::where('id_member', $id_member)->update([
            'nama_member' => $request->nama,
            'alamat' => $request->alamat,
            'jeniskelamin' => $request->jeniskelamin,
            'telp' => $request->telp,
        ]);

        return redirect('laundry/pelanggan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id_member)
    {

        // dd($id_member);
        Member::where('id_member', $id_member)->delete();
        return redirect('laundry/pelanggan');
    }
}
