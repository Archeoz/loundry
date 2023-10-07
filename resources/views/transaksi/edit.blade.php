@extends('index')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-7">
            <h1 class="h4 text-gray mb-2">ID Transaksi : <strong>{{ $transaksi->kode_invoice }}</strong></h1>
        </div>
        <div class="col-7">
            <h1 class="h4 text-grey mb-4">Nama Pelanggan : <strong>{{ $namapelanggan->nama_member }}</strong> </h1>
        </div>
    </div>
    <div class="card o-hidden border-0 shadow-lg">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row justify-content-center">

                <div class="col-lg-8">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Edit Data Transaksi</h1>
                        </div>
                        <form class="user" action="{{ url('laundry/updatetransaksi/'.$transaksi->id_transaksi) }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="row">
                                @if ($transaksi->dibayar == 'dibayar')
                                    <div class="col-md-6 form-group ">
                                        <h3 class="mt-3" style="text-align: center">Sudah Bayar</h3>
                                    </div>
                                @else
                                <div class="col-md-6 form-group">
                                        <div class="row">
                                            <div class="col-6">
                                                @if ($transaksi->dibayar == 'belum_dibayar')
                                                <label>Total : </label>
                                                @elseif ($transaksi->dibayar == 'hutang')
                                                <label>Hutang : </label>
                                                @endif
                                            </div>
                                            <input type="hidden" name="" id="status" value="{{ $transaksi->dibayar }}">
                                            @if ($transaksi->dibayar == 'belum_dibayar')
                                                <div class="col-6">
                                                    <h4 style="font-size: 20px" >Rp. {{ $detailtransaksi->qty }}</h4>
                                                    <input type="hidden" name="total" id="total" value="{{ $detailtransaksi->qty }}">
                                                </div>
                                            @elseif ($transaksi->dibayar == 'hutang')
                                                <div class="col-6">
                                                    <h4 style="font-size: 20px" >Rp. {{ $detailtransaksi->sisa_hutang }}</h4>
                                                    <input type="hidden" name="total" id="total" value="{{ $detailtransaksi->sisa_hutang }}">
                                                </div>
                                            @endif
                                        </div>
                                    <div class="mb-3 mb-sm-0">
                                        <input class="form-control" type="number" style="border-radius: 20px;height:50px;" id="bayar" name="bayar" onkeyup="hitungkembali();">
                                    </div>
                                </div>
                                @endif
                                <div class="col-md-6 form-group">
                                    <div class="col-md-7">
                                        <label for="">Status : </label>
                                    </div>
                                    <div class="mb-3 mb-sm-0">
                                        <select class="form-control form-control-select" name="status" id="exampleSelect" placeholder="Select Option" style="border-radius: 20px;height:50px;">
                                            <option value="{{ $transaksi->status }}" selected>{{ $transaksi->status }}</option>
                                            <option value="baru">Baru</option>
                                            <option value="proses">Proses</option>
                                            <option value="selesai">Selesai</option>
                                            <option value="diambil">Di Ambil</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <a class="btn btn-danger btn-user btn-block" href="{{ url('laundry/transaksi') }}">
                                        batal Update
                                    </a>
                                </div>
                                <div class="col-6">
                                    <a class="btn btn-primary btn-user btn-block" data-toggle="modal" data-target="#update">
                                        Update Transaksi
                                    </a>
                                </div>
                            </div>
                            <div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Apakah Anda Yakin Update Transaksi</h5>
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
                    <div class="row">
                        <div class="col-6">
                            @if ($transaksi->dibayar == 'belum_dibayar')
                            <label>Kembali : </label>
                            @elseif ($transaksi->dibayar == 'hutang')
                            <label>Sisa Hutang : </label>
                            @endif
                            <div class="mb-3">
                                <span class="form-control" type="text" id="tampilkembali"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function hitungkembali(){
        var status = document.getElementById('status').value;

        var total = parseFloat(document.getElementById('total').value);
        // var hutang = parseFloat(document.getElementById('hutang').value);
        var bayar = parseFloat(document.getElementById('bayar').value) || 0;
        // var jadiplus = hutang - hutang;
        if (bayar === 0) {
            var kembali = 0;
        } else {
            if (status === 'hutang') {
                var kembali = bayar + total;
        } else {
                var kembali = bayar - total;
        }

        }

        var tampiltotal = document.getElementById('tampilkembali');
        tampiltotal.textContent = 'Rp. ' + Math.ceil(kembali);

    }
    document.addEventListener("DOMContentLoaded", function() {
        hitungkembali();
    });
    document.getElementById('bayar').addEventListener("input", hitungkembali);
</script>
@endsection
