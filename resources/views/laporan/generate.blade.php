@extends('index')

@section('content')
<div class="container">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Transaksi</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class=" row card-header py-3">
            <h6 class="col-md-10 m-0 font-weight-bold text-primary">List Transaksi</h6>
            <a href="{{ url('laundry/generatelaporan') }}" class="col-md-2 m-0 font-weight-bold text-primary">Print Laporan : <i class="fas fa-print"></i></a>
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Id Transaksi</th>
                            <th>Pegawai</th>
                            <th>Member</th>
                            <th>Outlet</th>
                            <th>Paket</th>
                            <th>Total Harga Paket</th>
                            <th>Total</th>
                            <th>Tgl Masuk</th>
                            <th>Batas Waktu</th>
                            <th>Tgl Bayar</th>
                            <th>Status Pembayaran</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ( $datagenerate as $generate )
                        <tr>
                            <td>{{ $no++ }}.</td>
                            <td>{{ $generate->id_transaksi }}</td>
                            <td>{{ $generate->username_user }}</td>
                            <td>{{ $generate->member }}</td>
                            <td>{{ $generate->outlet }}</td>
                            <td>{{ $generate->paket }}</td>
                            <td>{{ $generate->total_harga_paket }}</td>
                            {{-- <td>
                                @foreach (explode('.',$generate->nama_paket) as $item)
                                    {{ $item }}
                                @endforeach
                            </td> --}}
                            {{-- <td>
                                @foreach ($generate as $item)
                                    {{ $item->nama_paket }}
                                @endforeach
                            </td> --}}
                            <td>{{ $generate->total }}</td>
                            <td>{{ $generate->tgl_masuk }}</td>
                            <td>{{ $generate->batas_waktu_bayar }}</td>
                            <td>{{ $generate->tgl_bayar }}</td>
                            <td>{{ $generate->status_pembayaran }}</td>
                            <td>{{ $generate->status }}</td>

                        </tr>
                        @endforeach
                        <div class="modal fade" id="deletemember" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-danger" id="exampleModalLabel">Apakah Anda Yakin Menghapus Akun</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                            {{-- <a href="{{ url('laundry/deletemember/'.$transaksi->id_member) }}" type="submit" class="btn btn-danger">Yakin</a> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@endsection
