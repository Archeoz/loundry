@extends('index')
@section('content')
<div class="container">
    <div class="row">
        <h1 class="h4 text-gray-900 mb-4">ID Transaksi : {{ $transaksi->id_transaksi }}</h1>
    </div>
    <div class="card o-hidden border-0 shadow-lg">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row justify-content-center">

                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Edit Data Transaksi</h1>
                        </div>
                        <form class="user" action="{{ url('laundry/updatetransaksi/'.$transaksi->id_transaksi) }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <div class="col-md-">
                                        <label for="">Status Bayar : </label>
                                    </div>
                                    <div class="mb-3 mb-sm-0">
                                        <select class="form-control form-control-select" name="statusbayar" id="exampleSelect" placeholder="Select Option" style="border-radius: 20px;height:50px;">
                                            <option value="{{ $transaksi->dibayar }}" selected>{{ $transaksi->dibayar }}</option>
                                            <option value="dibayar">Di Bayar</option>
                                            <option value="belum_dibayar">Belum Dibayar</option>
                                        </select>
                                    </div>
                                </div>
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
                            <a class="btn btn-primary btn-user btn-block" data-toggle="modal" data-target="#update">
                                Update Transaksi
                            </a>
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
