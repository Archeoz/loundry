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
                                <div class="col-md-5 mb-3">
                                    <select class="form-control form-select" name="paket" id="" onchange="this.form.submit()" style="border-radius: 20px;height:50px;">
                                        <option value="" disabled selected>---Pilih Paket---</option>
                                        @foreach ($paket as $paket)
                                        <option value="{{ $paket->id_paket }}">{{ $paket->nama_paket }}</option>
                                        @endforeach
                                    </select>
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

                            <input type="hidden" value="{{ $total }}" name="totalan">
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
                                    <div class="col-md-4">
                                        <label for="">Status Bayar : </label>
                                    </div>
                                    <div class="mb-3 mb-sm-0">
                                        <select class="form-control form-control-select" name="statusbayar" id="exampleSelect" placeholder="Select Option" style="border-radius: 20px;height:50px;">
                                            <option value="" disabled selected>Pilih Status Bayar</option>
                                            <option value="dibayar">Di Bayar</option>
                                            <option value="belum_dibayar">Belum Dibayar</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <div class="col-md-4">
                                        <label for="">Status : </label>
                                    </div>
                                    <div class="mb-3 mb-sm-0">
                                        <select class="form-control form-control-select" name="status" id="exampleSelect" placeholder="Select Option" style="border-radius: 20px;height:50px;">
                                            {{-- <option value="" disabled selected>Pilih Status</option> --}}
                                            <option value="baru" selected>Baru</option>
                                            {{-- <option value="proses">Proses</option>
                                            <option value="selesai">Selesai</option>
                                            <option value="diambil">Di Ambil</option> --}}
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <div class="col-md-5">
                                        <label for="">Biaya Tambahan : </label>
                                    </div>
                                    <div class="mb-3 mb-sm-0">
                                        <input type="number" class="form-control form-control-user" id="exampleFirstName" name="biayatambahan"
                                            placeholder="Insert Biaya Tambahan">
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <div class="col-md-4">
                                        <label for="">Diskon : </label>
                                    </div>
                                    <div class="mb-3 mb-sm-0">
                                        <input type="number" class="form-control form-control-user" id="exampleFirstName" name="diskon"
                                            placeholder="Insert Diskon">
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <div class="col-md-8">
                                        <label for="">Batas Waktu Bayar : </label>
                                    </div>
                                    <div class="mb-3 mb-sm-0">
                                        <input type="date" class="form-control form-control-user" id="exampleFirstName" name="bataswaktu"
                                            placeholder="Insert Batas Waktu">
                                    </div>
                                </div>
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
@endsection
