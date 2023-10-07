<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\DetailTransaksi;
use App\Models\Generate;
use Barryvdh\DomPDF\Facade\Pdf;
class GenerateController extends Controller
{
    public function index()
    {
        Generate::truncate();
        // $generatesemua = Generate::all();
        // $generatesemua->delete;
        $generate = DetailTransaksi::join('transaksis', 'transaksis.id_transaksi', '=','detail_transaksis.id_transaksi')
        ->join('users','users.id','=','transaksis.id_user')
        ->join('pakets','pakets.id_paket','=','detail_transaksis.id_paket')
        ->join('members','members.id_member','=','transaksis.id_member')
        ->join('outlets','outlets.id_outlet','=','transaksis.id_outlet')
        ->select('users.*','members.*','outlets.*','detail_transaksis.*','pakets.*','transaksis.*')->get();

        foreach ($generate as $generate) {
           $generatemodel = Generate::firstOrNew([
                'id_transaksi' =>$generate->id_transaksi ,
                'kode_invoice' =>$generate->kode_invoice ,
                'username_user' =>$generate->username ,
                'member' =>$generate->nama_member ,
                'outlet' =>$generate->nama_outlet ,
                'paket' =>$generate->nama_paket ,
                'total_harga_paket' =>$generate->total_harga_paket ,
                'total' =>$generate->qty ,
                'sisa_hutang' =>$generate->sisa_hutang ,
                'tgl_masuk' =>$generate->tgl ,
                'batas_waktu_bayar' =>$generate->batas_waktu ,
                'tgl_bayar' =>$generate->tgl_bayar ,
                'status_pembayaran' =>$generate->dibayar ,
                'status' =>$generate->status ,
            ]);
            $generatemodel->save();
        }
        $datagenerate = Generate::all();
        // return $transaksi;
        return view('laporan.generate',compact('datagenerate'));
    }
    // use PDF;
    public function cetak()
    {

        $generate = Generate::all();
        // return view('laporan.tampilancetak',compact('generate'));
        // view()->share()->share;
        // return view('laporan.tampilancetak',compact('generate'));

        // Generate::truncate();
        //Mengambil semua data di blade
        // $generate = DetailTransaksi::join('transaksis', 'transaksis.id_transaksi', '=','detail_transaksis.id_transaksi')
        // ->join('users','users.id','=','transaksis.id_user')
        // ->join('pakets','pakets.id_paket','=','detail_transaksis.id_paket')
        // ->join('members','members.id_member','=','transaksis.id_member')
        // ->join('outlets','outlets.id_outlet','=','transaksis.id_outlet')
        // ->select('users.*','members.*','outlets.*','detail_transaksis.*','pakets.*','transaksis.*')->get();
        // //  dd($generate);
        // foreach ($generate as $generate) {
        //     Generate::create([
        //         'id_transaksi' =>$generate->id_transaksi ,
        //         'username_user' =>$generate->username ,
        //         'member' =>$generate->nama_member ,
        //         'outlet' =>$generate->nama_outlet ,
        //         'paket' =>$generate->nama_paket ,
        //         'total_harga_paket' =>$generate->totalan ,
        //         'total' =>$generate->qty ,
        //         'tgl_masuk' =>$generate->tgl ,
        //         'batas_waktu_bayar' =>$generate->batas_waktu ,
        //         'tgl_bayar' =>$generate->tgl_bayar ,
        //         'status_pembayaran' =>$generate->dibayar ,
        //         'status' =>$generate->status ,
        //     ]);
        // }
        // $generate = Generate::all();
        // return back();
        // $view = view('laporan.generate',compact('generate'));


        // //Konversi blade ke html
        // // $html = $view->render();

        // //membuat nama file pdf
        $namafile = 'laporan_' . date('Ymd'). '.pdf';

        // // AMbil data dari table
        // $table = Generate::all();


        //Cetak html ke pdf
        $pdf = PDF::loadView('laporan.tampilancetak',compact('generate'))->setPaper('a4','landscape');
        // dd($pdf);
        return $pdf->download($namafile);

        // if ($pdf) {
        //     return 'hello';
        // }

    }
}
