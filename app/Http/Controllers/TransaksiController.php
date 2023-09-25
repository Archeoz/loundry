<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Paket;
use App\Models\Member;
use App\Models\Outlet;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\DetailTransaksi;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreTransaksiRequest;
use App\Http\Requests\UpdateTransaksiRequest;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function belipaket(Request $request)
    {
        // return $request->paket;
        if ($request->has('paket')){

            $id_insert = $request->paket;
            // dd($id_insert);
            $paket = Paket::where('id_paket', $id_insert)->first();
            // dd($paket);
            $pilihan = session()->get('pilihan',[]);
            if (isset($pilihan[$id_insert])) {
                $pilihan[$id_insert]['jumlah']+5;
            }else{
                $pilihan[$id_insert] = [
                    'id_paket' => $id_insert,
                    'id_outlet' => $paket->id_outlet,
                    'jenis' => $paket->jenis,
                    'nama_paket' => $paket->nama_paket,
                    'harga' => $paket->harga,
                    'jumlah' => $request->jumlah,
                ];
            }
        }else {
            return back();
        }

        session()->put('pilihan',$pilihan);
        // $id_insert = $request->paket;
        // $paket = Paket::where('id_paket', $id_insert)->first();
        // $pilihan = session()->get('pilihan', []);
        // $angka1 = session()->get('totalhargapaket', 0);

        // if (isset($pilihan[$id_insert])) {
        //     $pilihan[$id_insert]['jumlah']++;
        // } else {
        //     $pilihan[$id_insert] = [
        //         'id_paket' => $id_insert,
        //         'id_outlet' => $paket->id_outlet,
        //         'jenis' => $paket->jenis,
        //         'nama_paket' => $paket->nama_paket,
        //         'harga' => $paket->harga,
        //         'jumlah' => 1,
        //         'totalhargapaket' => $angka1 + ($paket->jumlah * $paket->harga),
        //     ];
        // }

        // session()->put('pilihan', $pilihan);
        // session()->put('totalhargapaket', $angka1);

        return back();
    }

    public function tambah($id_paket)
    {
        $pilihan = session()->get('pilihan');
        $pilihan[$id_paket]['jumlah']++;
        session()->put('pilihan',$pilihan);

        return back();
    }

    public function kurang($id_paket)
    {
        $pilihan = session()->get('pilihan');
        if ($pilihan[$id_paket]['jumlah'] > 1) {
            $pilihan[$id_paket]['jumlah'] --;
            session()->put('pilihan',$pilihan);
        } else {
            unset($pilihan[$id_paket]);
            session()->put('pilihan',$pilihan);
        }
        return back();

    }

    public function hapus($id_paket)
    {
        $pilihan = session()->get('pilihan');
        // if (isset($pilihan[$id_paket])) {
        //     unset($pilihan[$id_paket]);
        //     session()->put('pilihan',$pilihan);

        // }
        // session()->forget('pilihan'[$id_paket]);
        unset($pilihan[$id_paket]);
        session()->put('pilihan',$pilihan);
        return back();
    }

    public function batal()
    {
        session()->forget('pilihan');
        session()->forget('totalhargapaket');
        return redirect('laundry/transaksi');
    }

    public function index()
    {
        $transaksi = DetailTransaksi::join('transaksis','transaksis.id_transaksi','=','detail_transaksis.id_transaksi')
        ->join('users','users.id','=','transaksis.id_user')
        ->join('pakets','pakets.id_paket','=','detail_transaksis.id_paket')
        ->join('members','members.id_member','=','transaksis.id_member')
        ->join('outlets','outlets.id_outlet','=','transaksis.id_outlet')
        ->select('users.*','members.*','outlets.*','detail_transaksis.*','pakets.*','transaksis.*')->get();

        // return $transaksi;
        return view('transaksi.data',compact('transaksi'));
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

    public function registerpage()
    {
        // session()->forget('pilihan');
        $user = Auth::user();
        $member = Member::all();

        if ($user->role == 'admin') {
            $paket = Paket::join('outlets','outlets.id_outlet','=','pakets.id_outlet')
            ->select('outlets.*','pakets.*')->get();
            $outlet = Outlet::all();


            return view('transaksi.register', compact('user','paket','outlet','member'));
        }
        if ($user->role == 'kasir') {
            $paket = Paket::where('id_outlet',$user->id_outlet)->get();
            $outlet = Outlet::where('id_outlet',$user->id_outlet)->get();

            return view('transaksi.register', compact('user','paket','member','outlet'));
        }
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $number = 0;
        $pajak = 0.11;
        $kode = date('YmdHis');

        // $ya = $request->diskon;
        $total = $request->totalan;
        $didiskon = ($total + $request->biayatambahan) * $request->diskon;
        $costtambahan = $total + $request->biayatambahan - $didiskon;
        $totalpajak = $costtambahan * $pajak;
        $totals = $number + $costtambahan + $totalpajak;

        // return $totals;

        // Menghitung tanggal batas waktu 4 hari ke depan
        $batasWaktu = Carbon::now()->addDays(4);
        //lihat sudah bayar atau belum
        if ($request->bayarnow >= $total) {
            $buat = [
                'id_outlet' => $request->outlet,
                'id_member' => $request->member,
                'id_user' => $user->id,
                'kode_invoice' => $kode,
                'tgl' => now(),
                'batas_waktu' => null,
                'tgl_bayar' =>now(),
                'biaya_tambahan' => $request->biayatambahan,
                'diskon' => $request->diskon,
                'pajak' => $totalpajak,
                'status' => "baru",
                'dibayar' => "dibayar",
            ];
        } else if($request->bayarnow < $total) {
            $buat = [
                'id_outlet' => $request->outlet,
                'id_member' => $request->member,
                'id_user' => $user->id,
                'kode_invoice' => $kode,
                'tgl' => now(),
                'batas_waktu' => $batasWaktu,
                'tgl_bayar' =>null,
                'biaya_tambahan' => $request->biayatambahan,
                'diskon' => $request->diskon,
                'pajak' => $totalpajak,
                'status' => "baru",
                'dibayar' => "belum_dibayar",
            ];
        }
        Transaksi::create($buat);
        // dd($buat);
        $transaksi = Transaksi::latest()->first();
        $sesipilihan = session()->get('pilihan');
        // $sessi = session()->get('totalhargapaket');
        // dd($sesipilihan);
        //mengambil inputan dari blade

        //

        // Mengambil semua data di sesi pilihan
        $semuadatasesi = [];
        foreach ($sesipilihan as $key => $value) {
            $semuadatasesi[] = $value['id_paket'];
        }
        //
        // dd($semuadatasesi);
        // Menggabungkan semua data dari sesi pilihan menjadi satu string, dengan koma sebagai pemisah
        $penyatuandatasesi = implode('.',$semuadatasesi);

        //
        // return $sesipilihan;

        $totaljumlahperpaket = [];
        $totalpricepaket = [];
        foreach ($sesipilihan as $sesipilihan) {
            $totaljumlahpaket[] = $sesipilihan['jumlah'];
            $totalpricepaket[] = $sesipilihan['jumlah'] * $sesipilihan['harga'];
        }
        // dd($totaljumlahpaket);
        // dd($totalpricepaket);

            // $totalhargapaket = $request->totalhargapaket;

            // if (!empty($sesipilihan)) {

            //         $harga = $sesipilihan->harga;
            //         $jumlah = $sesipilihan['jumlah'];
            //         $subtotalan = $harga * $jumlah;
            //         $totalhargapaket = $totalhargapaket + $subtotalan;

            // }
            // return $totalhargapaket;

        // foreach (session('pilihan') as $key => $value) {
            // dd($transaksi);
            // $orderdetailcreate = [
            //     'id_transaksi' => $transaksi->id_transaksi,
            //     'id_paket' => $penyatuandatasesi,
            //     'qty' => $total,
            //     'keterangan' => $request->keterangan,
            // ];
            // // dd($orderdetailcreate);
            // DetailTransaksi::create($orderdetailcreate);

            // dd($value);
        // }

        foreach (session('pilihan') as $key => $value) {
            // dd($transaksi);
            $orderdetailcreate = [
                'id_transaksi' => $transaksi->id_transaksi,
                'id_paket' => $value['id_paket'],
                'jumlah_paket' => $value['jumlah'],
                'total_harga_paket' => $sesipilihan['jumlah'] * $sesipilihan['harga'],
                'qty' => $totals,
                'keterangan' => $request->keterangan,
            ];
            DetailTransaksi::create($orderdetailcreate);

            // dd($value);
        }
        // dd($orderdetailcreate);
        session()->forget('pilihan');
        session()->forget('pilihan');
        return redirect('laundry/transaksi');
    }

    public function struk(){
        $auth = Auth::user();
        $outlet = Outlet::where('id_outlet',$auth->id_outlet)->first();
        // dd($outlet);
        $transaksi = Transaksi::latest()->first();
        $member = Member::where('id_member',$transaksi->id_member)->first();
        // dd($transaksi);

        $struk = DetailTransaksi::join('transaksis','transaksis.id_transaksi','=','detail_transaksis.id_transaksi')
        ->join('pakets','pakets.id_paket','=','detail_transaksis.id_paket')
        ->where('transaksis.id_transaksi',$transaksi->id_transaksi)
        ->select('detail_transaksis.*','pakets.*','transaksis.*')->get();
        // dd($struk);
        return view('struk',compact('struk','outlet','transaksi','member'));

    }
    /**
     * Display the specified resource.
     */
    public function tampilupdate(Request $request,$id_transaksi)
    {
        $transaksi = Transaksi::where('id_transaksi', $id_transaksi)->first();
        $detailtransaksi = DetailTransaksi::where('id_transaksi',$id_transaksi)->first();
        $namapelanggan = Member::where('id_member','=',$transaksi->id_member)->first();
        // dd($namapelanggan);
        return view('transaksi.edit',compact('transaksi','namapelanggan','detailtransaksi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function updatetransaksi(Request $request,$id_transaksi)
    {
        $user = Auth::user();
        $total = $request->total;

        // if ($user->role == 'admin') {
            if ($request->bayar >= $total) {
                Transaksi::where('id_transaksi',$id_transaksi)->update([
                    'dibayar' => 'dibayar',
                    'status' => $request->status,
                    'tgl_bayar' => now(),
                ]);
            } else{
                Transaksi::where('id_transaksi',$id_transaksi)->update([
                    'dibayar' => 'belum_dibayar',
                    'status' => $request->status,
                    'tgl_bayar' => null,
                ]);
            }

        // } else {

        // }
        return redirect('laundry/transaksi');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransaksiRequest $request, Transaksi $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_transaksi)
    {
        DetailTransaksi::where('id_transaksi',$id_transaksi)->delete();
        Transaksi::where('id_transaksi',$id_transaksi)->delete();

        // if (!$transaksi || !$detailtransaki) {
        //     // Handle jika data tidak ditemukan
        //     return redirect()->back()->with('error', 'Data tidak ditemukan');
        // }
        // $detailtransaki->delete();
        // $transaksi->delete();

        return back();
    }

    public function error(){

    }
}
