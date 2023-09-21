<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Http\Requests\StorePaketRequest;
use App\Http\Requests\UpdatePaketRequest;
use App\Models\Outlet;
use Illuminate\Http\Request;

class PaketController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $paket = Paket::join('outlets','outlets.id_outlet','=','pakets.id_outlet')
        ->select('outlets.*','pakets.*')->get();
        // return $paket->id_paket;
        return view('paket.data',compact('paket'));
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

    public function tampilregister()
    {
        $outlet = Outlet::all();
        return view('paket.register',compact('outlet'));
    }

     public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required',
            'harga' => 'required',
            'outlet' => 'required',
            'jenis' => 'required',
        ]);

        Paket::create([
            'nama_paket' => $data['nama'],
            'harga' => $data['harga'],
            'jenis' => $data['jenis'],
            'id_outlet' => $data['outlet'],
        ]);
        return redirect('laundry/paket');

    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Paket $paket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    public function updatepage($id_paket)
    {
        $outlet = Outlet::all();
        $paket = Paket::where('id_paket',$id_paket)->first();
        return view('paket.edit',compact('paket','outlet'));
    }
    public function update(Request $request,$id_paket)
    {
        Paket::where('id_paket',$id_paket)->update([
            'nama_paket' => $request->nama,
            'harga' => $request->harga,
            'jenis' => $request->jenis,
            'id_outlet' => $request->outlet,
        ]);
        return redirect('laundry/paket');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_paket)
    {

        Paket::where('id_paket', $id_paket)->delete();
        return redirect('laundry/paket');
    }
}
