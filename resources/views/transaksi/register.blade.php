@extends('index')
@section('content')
<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row justify-content-center">

                <div class="col-lg-12">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Register Transaksi</h1>
                        </div>
                        <form action="{{ url('laundry/belipaket') }}" method="GET">
                            <div class="row mb-6">
                                <div class="col-md-8 mb-2">
                                    <span>Pilih Paket</span>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <select class="form-control form-select" name="paket" id="" style="border-radius: 15px;height:40px;">
                                        <option value="" disabled selected>---Pilih Paket---</option>
                                        @foreach ($paket as $paket)
                                        <option value="{{ $paket->id_paket }}">{{ $paket->nama_paket }} --- Outlet : {{ $paket->nama_outlet }}</span></option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="number" class="form-control form-control-user" style="border-radius: 15px;height:40px;" name="jumlah" placeholder="--- Isikan Jumlah Paket ---">
                                </div>
                                <div class="row">
                                    <div class="col-md-3 ml-3 mb-2">
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table">
                                    <thead>
                                        <th>No</th>
                                        <th>Nama Paket</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th>Total</th>
                                        <th>Opsi</th>
                                    </thead>

                                    <tbody>
                                        @php
                                            $no = 1;
                                            $total = 0;
                                            $totalhargapaket= 0;
                                            @endphp
                                        {{-- @if (session()->has('pilihan'))
                                            @php
                                                $totalhargapaket = 0;

                                                // Ambil semua data dari session pilihan
                                                $pilihan = session('pilihan');

                                                // ID paket yang ingin Anda kalkulasikan (misalnya, 1)
                                                $targetPaketId = 1;

                                                // Loop melalui semua data dalam session pilihan
                                                foreach ($pilihan as $item) {
                                                    if ($item['id_paket'] == $targetPaketId) {
                                                        $totalhargapaket = $item['harga'] * $item['jumlah'];
                                                        // break; // Keluar dari loop jika ID paket yang sesuai ditemukan
                                                    }
                                                }
                                            @endphp
                                        @endif --}}


                                        @if (session()->has('pilihan'))
                                        @foreach (session('pilihan') as $pilihan)
                                        <tr>
                                            <td>{{ $no ++ }}</td>
                                            <td>{{ $pilihan['nama_paket'] }}</td>
                                            <td class="text-lg">
                                                <a href="{{ url('laundry/kurang/'.$pilihan['id_paket']) }}" class="text-decoration-none text-warning font-weight-bold text-lg">[-] </a>
                                                {{ $pilihan['jumlah'] }}
                                                <a href="{{ url('laundry/tambah/'.$pilihan['id_paket']) }}" class="text-decoration-none text-success font-weight-bold text-lg">[+]</a></td>
                                            </td>
                                            <td>{{ $pilihan['harga'] }}</td>
                                            <td>{{ $pilihan['harga'] * $pilihan['jumlah'] }}</td>
                                            {{-- <input type="hidden" value="{{ $totalhargapaket = $pilihan['harga'] * $pilihan['jumlah'] }}" name="totalhargapaket">
                                            <td>{{ $totalhargapaket }}</td> --}}
                                            @php
                                                $totalhargapaket = 0;
                                            @endphp
                                            <td>
                                                <a href="{{ url('laundry/hapuspilihan/'.$pilihan['id_paket']) }}" class="text-danger font-weight-bold"><i class="fa fa-trash"></i> Hapus</a>
                                            </td>
                                        </tr>
                                        @php
                                            $total = $total + ($pilihan['harga'] * $pilihan['jumlah']);
                                        @endphp
                                        @endforeach
                                        @endif

                                        <tr>
                                            <td colspan="4">Total Pembayaran</td>
                                            <td>{{ $total }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <form class="user" action="{{ url('laundry/registertransaksi') }}" enctype="multipart/form-data" method="POST">
                            @csrf

                            <input type="hidden" value="{{ $total }}" id="totals" name="totalan">
                            {{-- <input type="hidden" value="{{ $totalhargapaket }}" name="totalhargapaket"> --}}
                            <div class="row mt-3">
                                <div class="col-md-6 form-group">
                                    <div class="col-md-4">
                                        <label for="">Member : </label>
                                    </div>
                                    <div class="mb-3 mb-sm-0">
                                        <select class="form-control form-control-select" name="member" id="exampleSelect" placeholder="Select Option" style="border-radius: 20px;height:50px;">
                                            <option value="" disabled selected>Pilih Member</option>
                                            @foreach ($member as $member)
                                            <option value="{{ $member->id_member }}">{{ $member->nama_member }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @if (Auth::user()->role == 'admin')
                                <div class="col-md-6 form-group">
                                    <div class="col-md-4">
                                        <label for="">Outlet : </label>
                                    </div>
                                    <div class="mb-3 mb-sm-0">
                                        <select class="form-control form-control-select" name="outlet" id="exampleSelect" placeholder="Select Option" style="border-radius: 20px;height:50px;">
                                            <option value="" disabled selected>Pilih Outlet</option>
                                            @foreach ($outlet as $outlet)
                                            <option value="{{ $outlet->id_outlet }}">{{ $outlet->nama_outlet }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @endif
                                @if (Auth::user()->role == 'kasir')
                                <div class="col-md-6 form-group">
                                    <div class="col-md-4">
                                        <label for="">Outlet : </label>
                                    </div>
                                    <div class="mb-3 mb-sm-0">
                                        <select class="form-control form-control-select" name="outlet" id="exampleSelect" placeholder="Select Option" style="border-radius: 20px;height:50px;">
                                            @foreach ($outlet as $outlet)
                                            <option selected{{ $outlet->id_outlet == $user->id_outlet }} value="{{ $outlet->id_outlet }}">{{ $outlet->nama_outlet }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @endif
                                <div class="col-md-6 form-group">
                                    <div class="col-md-5">
                                        <label for="">Bayar Sekarang : </label>
                                    </div>
                                    <div class="mb-3 mb-sm-0">
                                        <input type="number" class="form-control form-control-user"  name="bayarnow" id="bayarnow" onkeyup="hitung();"
                                        placeholder="Insert Duit">
                                        <span class="text-danger ml-2" style="font-size: 12px">* Jika Tidak Membayar,Kosongkan</span>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <div class="col-md-5">
                                        <label for="">Biaya Tambahan : </label>
                                    </div>
                                    <div class="mb-3 mb-sm-0">
                                        <input type="number" class="form-control form-control-user" id="biayatambahan" name="biayatambahan" onkeyup="hitung();"
                                            placeholder="Insert Biaya Tambahan">
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <div class="col-md-4">
                                        <label for="">Diskon : </label>
                                    </div>
                                    <div class="mb-3 mb-sm-0">
                                        {{-- <input type="number" class="form-control form-control-user" id="diskon" name="diskon" onkeyup="hitung();"
                                            placeholder="Insert Diskon"> --}}
                                        <select class="form-control form-control-select" name="diskon" id="diskon" onkeyup="hitung();" style="border-radius: 20px;height:50px;">
                                            <option value="0">Batal</option>
                                            <option value="0.10">10%</option>
                                            <option value="0.25">25%</option>
                                            <option value="0.50">50%</option>
                                            <option value="0.75">75%</option>
                                        </select>
                                    </div>
                                </div>
                                {{-- <div class="col-md-6 form-group">
                                    <div class="col-md-8">
                                        <label for="">Batas Waktu Bayar : </label>
                                    </div>
                                    <div class="mb-3 mb-sm-0">
                                        <input type="date" class="form-control form-control-user" id="exampleFirstName" name="bataswaktu"
                                            placeholder="Insert Batas Waktu">
                                    </div>
                                </div> --}}
                                <div class="col-md-6 form-group">
                                    <div class="col-md-4">
                                        <label for="">Keterangan : </label>
                                    </div>
                                    <div class="mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="exampleFirstName"  name="keterangan"
                                            placeholder="Insert Keterangan">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-6">
                                    <label>Total Bayar : </label>
                                    <div class="mb-3">
                                        <span class="form-control" type="text" id="tampiltotal"></span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label>Kembali : </label>
                                    <div class="mb-3">
                                        <span class="form-control" type="text" id="tampilkembali"></span>
                                    </div>
                                </div>
                            </div>
                                <div class="row mt-5">
                                    <div class="col-md-6">
                                        <a class="btn btn-danger btn-user btn-block" href="{{ url('laundry/batal') }}">
                                            Batalkan Transaksi
                                        </a>

                                    </div>
                                    <div class="col-md-6">
                                        <a class="btn btn-primary btn-user btn-block" data-toggle="modal" data-target="#registermember ">
                                            Register Transaksi
                                        </a>

                                    </div>
                                </div>
                                <div class="modal fade" id="registermember" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Apakah Anda Yakin Membuat Transaksi</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Yakin</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function hitung()
    {
        var total = parseFloat(document.getElementById('totals').value);
        var biayatambahan = parseFloat(document.getElementById('biayatambahan').value) || 0;
        var diskon = parseFloat(document.getElementById('diskon').value) || 0;
        var pajak = 0.11;
        var bayarnow = parseFloat(document.getElementById('bayarnow').value) || 0;
        // var bayarskrg = ;

        var didiskon = (total + biayatambahan) * diskon;
        var totalbiaya = total + biayatambahan - didiskon;
        var dipajak = totalbiaya * pajak;
        var hasil = totalbiaya + dipajak;

        if (bayarnow === 0) {
            var bayarskrg = 0;
        } else {
            var bayarskrg = bayarnow - hasil;
        }

        // if (isNaN('hasil')) {
        //     hasil = 0;
        // }

        var tampiltotal =  document.getElementById('tampiltotal');
        // tampiltotal.textContent = 'Rp. ' + formatRibuan(Math.ceil(hasil));
        tampiltotal.textContent = 'Rp. ' + Math.ceil(hasil);

        var tampilkembali = document.getElementById('tampilkembali');
        // tampilkembali.textContent = 'Rp. ' + formatRibuan(Math.ceil(bayarskrg));
        tampilkembali.textContent = 'Rp. ' + Math.ceil(bayarskrg);
    }

    function formatRibuan(angka) {
        // return (Math.round(angka * 0.001) * 1000).toLocaleString();
        // Membulatkan angka ke ribuan terdekat dengan mempertahankan tiga digit paling awal
        var ribuanTerdekat = Math.ceil(angka / 1000) * 1000;

        // Menggunakan toLocaleString() untuk menambahkan tanda koma sebagai pemisah ribuan
        return ribuanTerdekat.toLocaleString();
    }
    // function hitungkembalian()
    // {
    //     var duit = parseFloat(document.getElementById('bayarnow').value) || 0;
    //     var total = parseFloat(document.getElementById('tampiltotal').value) || 0;

    //     var kembali = duit - total;
    //     // if (isNaN('kembali')) {
    //     //         kembali = 0;
    //     // }

    //     var tampilkembali = document.getElementById('tampilkembali');
    //     tampilkembali.textContent = 'Rp. ' + Math.ceil(total);
    // }

    // Panggil fungsi hitung saat halaman dimuat
    document.addEventListener("DOMContentLoaded", function() {
        hitung();
        formatRibuan();
    });

    //panggil fungsi hitung kembali
    // document.addEventListener("DOMContentLoaded", function() {
    //     hitungkembalian();
    // });

    // Panggil fungsi hitung saat input biaya tambahan atau diskon berubah
    document.getElementById('biayatambahan').addEventListener("input", hitung);
    document.getElementById('diskon').addEventListener("input", hitung);
    document.getElementById('bayarnow').addEventListener("input", hitung);
</script>
{{-- <script>
    var total = 0; // Inisialisasi total

    function hitung() {
        var biayatambahan = parseFloat(document.getElementById('biayatambahan').value) || 0;
        var diskon = parseFloat(document.getElementById('diskon').value) || 0;
        var pajak = 0.11;

        var totalbiaya = total + biayatambahan - diskon;
        var dipajak = totalbiaya * pajak;
        var hasil = totalbiaya + dipajak;

        var tampiltotal =  document.getElementById('tampiltotal');
        tampiltotal.textContent = 'Rp. ' + Math.ceil(hasil);
    }

    function hitungkembalian() {
        var duit = parseFloat(document.getElementById('bayarnow').value) || 0;
        var kembali = duit - total;

        var tampilkembali = document.getElementById('tampilkembali');
        tampilkembali.textContent = 'Rp. ' + Math.ceil(kembali);
    }

    document.addEventListener("DOMContentLoaded", function() {
        hitung(); // Panggil hitung saat halaman dimuat
        hitungkembalian(); // Panggil hitungkembalian saat halaman dimuat
    });

    // Panggil fungsi hitung saat input biaya tambahan atau diskon berubah
    document.getElementById('biayatambahan').addEventListener("input", hitung);
    document.getElementById('diskon').addEventListener("input", hitung);
    document.getElementById('bayarnow').addEventListener("input", hitungkembalian);

</script> --}}
@endsection
