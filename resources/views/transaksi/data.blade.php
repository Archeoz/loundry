@extends('index')

@section('content')
<div class="container">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Transaksi</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List Transaksi</h6>
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
                            <th>Jumlah</th>
                            <th>Total Harga Paket</th>
                            <th>Total Keseluruhan</th>
                            <th>Tgl Masuk</th>
                            <th>Batas Waktu</th>
                            <th>Tgl Bayar</th>
                            <th>Keterangan</th>
                            <th>Status Pembayaran</th>
                            <th>Status</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ( $transaksi as $transaksis )
                        <tr>
                            <td>{{ $no++ }}.</td>
                            <td>{{ $transaksis->id_transaksi }}</td>
                            <td>{{ $transaksis->username }}</td>
                            <td>{{ $transaksis->nama_member }}</td>
                            <td>{{ $transaksis->nama_outlet }}</td>
                            <td>{{ $transaksis->nama_paket }}</td>
                            <td>{{ $transaksis->jumlah_paket }}</td>
                            <td>{{ $transaksis->total_harga_paket }}</td>
                            {{-- <td>
                                @foreach (explode('.',$transaksis->nama_paket) as $item)
                                    {{ $item }}
                                @endforeach
                            </td> --}}
                            {{-- <td>
                                @foreach ($transaksis as $item)
                                    {{ $item->nama_paket }}
                                @endforeach
                            </td> --}}
                            <td>{{ $transaksis->qty }}</td>
                            <td>{{ $transaksis->tgl }}</td>
                            <td>{{ $transaksis->batas_waktu }}</td>
                            <td>{{ $transaksis->tgl_bayar }}</td>
                            <td>{{ $transaksis->keterangan }}</td>
                            @if ($transaksis->dibayar == 'dibayar')
                                <td>
                                    <a href="{{ url('laundry/updatetransaksipage/'.$transaksis->id_transaksi) }}" class="btn btn-success">{{ $transaksis->dibayar }}</a>
                                </td>

                            @elseif ($transaksis->dibayar == 'belum_dibayar')
                                <td>
                                    <a href="{{ url('laundry/updatetransaksipage/'.$transaksis->id_transaksi) }}" class="btn btn-warning">{{ $transaksis->dibayar }}</a>
                                </td>
                            @endif
                            @if ($transaksis->status == 'baru')
                                <td>
                                    <a href="{{ url('laundry/updatetransaksipage/'.$transaksis->id_transaksi) }}" class="btn btn-light">{{ $transaksis->status }}</a>
                                </td>
                            @elseif ($transaksis->status == 'proses')
                                <td>
                                    <a href="{{ url('laundry/updatetransaksipage/'.$transaksis->id_transaksi) }}" class="btn btn-warning">{{ $transaksis->status }}</a>
                                </td>
                            @elseif ($transaksis->status == 'selesai')
                                <td>
                                    <a href="{{ url('laundry/updatetransaksipage/'.$transaksis->id_transaksi) }}" class="btn btn-primary">{{ $transaksis->status }}</a>
                                </td>
                            @elseif ($transaksis->status == 'diambil')
                                <td>
                                    <a href="{{ url('laundry/updatetransaksipage/'.$transaksis->id_transaksi) }}" class="btn btn-success">{{ $transaksis->status }}</a>
                                </td>
                            @endif

                            <td class="">
                                <a href="" data-toggle="modal" data-target="#deletemember{{ $transaksis->id_transaksi }}"  class="ml-2 text-danger"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                        <div class="modal fade" id="deletemember{{ $transaksis->id_transaksi }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-danger" id="exampleModalLabel">Apakah Anda Yakin Menghapus Transaksi </h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                            <a href="{{ url('laundry/deletemember/'.$transaksis->id_transaksi) }}" type="submit" class="btn btn-danger">Yakin</a>
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
