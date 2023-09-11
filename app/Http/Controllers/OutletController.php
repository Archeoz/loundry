<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use Illuminate\Http\Request;
use App\Http\Requests\StoreOutletRequest;
use App\Http\Requests\UpdateOutletRequest;


class OutletController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $outlet = Outlet::all();
        return view('outlet.data',compact('outlet'));
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

    public function tampil()
    {
        return view('outlet.register');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'telp' => 'required',
        ]);

        Outlet::create([
            'nama_outlet' => $data['nama'],
            'alamat' => $data['alamat'],
            'telp' => $data['telp'],
        ]);

        return redirect('laundry/outlet');
    }

    /**
     * Display the specified resource.
     */
    public function show(Outlet $outlet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Outlet $outlet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    public function tampilupdate($id_outlet)
    {
        $outlet = Outlet::where('id_outlet', $id_outlet)->first();
        return view('outlet.edit',compact('outlet'));
    }

    public function update(Request $request,$id_outlet)
    {
        $data = $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'telp' => 'required',
        ]);

        Outlet::where('id_outlet',$id_outlet)->update([
            'nama_outlet' => $data['nama'],
            'alamat' => $data['alamat'],
            'telp' => $data['telp'],
        ]);
        return redirect('laundry/outlet');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id_outlet)
    {

        Outlet::where('id_outlet',$id_outlet)->delete();
        return redirect('laundry/outlet');
    }
}
