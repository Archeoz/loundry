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
            <form class="user mb-3" action="{{ url('laundry/filtertanggal') }}" method="get">

                <div class="row">
                    <div class="col-md-3">
                        <label for="">Tanggal Awal</label>
                        <input class="form-control" type="date" id="tanggalawal" name="tanggalawal" >
                    </div>
                    <div class="col-md-3">
                        <label for="">Tanggal Akhir</label>
                        <input class="form-control" type="date" id="tanggalakhir" name="tanggalakhir">
                    </div>
                    <div class="col-md-2">
                        <label for="">Status Bayar</label>
                        <select name="status_bayar" class="form-control form-select" id="">
                            <option value="" disabled selected>=Pilih Status=</option>
                            <option value="hutang">Hutang</option>
                            <option value="dibayar">Di Bayar</option>
                            <option value="belum_dibayar">Belum Dibayar</option>
                        </select>
                    </div>
                    <div class="col-md-2 pt-4 mt-2">
                        <div class="row">
                            <button type="submit" class="btn btn-primary">Cari</button>
                            <a href="{{ url('laundry/transaksi') }}" class="btn btn-warning ml-2">Reset Filter</a>
                        </div>
                    </div>
                    <div class="col-md-2 pt-2">
                    </div>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable"  width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Id Transaksi</th>
                            <th>Kode Invoice</th>
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
                            <th>Sisa Hutang</th>
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
                            <td>{{ $transaksis->kode_invoice }}</td>
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
                            <td>{{ $transaksis->sisa_hutang }}</td>
                            <td>{{ $transaksis->keterangan }}</td>
                            @if ($transaksis->dibayar == 'dibayar')
                                <td>
                                    <a href="{{ url('laundry/updatetransaksipage/'.$transaksis->id_transaksi) }}" class="btn btn-success">{{ $transaksis->dibayar }}</a>
                                </td>

                            @elseif ($transaksis->dibayar == 'belum_dibayar')
                                <td>
                                    <a href="{{ url('laundry/updatetransaksipage/'.$transaksis->id_transaksi) }}" class="btn btn-warning">{{ $transaksis->dibayar }}</a>
                                </td>
                            @elseif ($transaksis->dibayar == 'hutang')
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
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
    // Capture date input changes
    $('#tanggalawal, #tanggalakhir').on('input', function () {
        // Get the selected dates
        var startDate = $('#tanggalawal').val();
        var endDate = $('#tanggalakhir').val();

        // Perform an AJAX request to fetch filtered data
        $.ajax({
            url: "{{ url('laundry/filtertanggal') }}",
            method: "GET",
            data: {
                tanggalawal: startDate,
                tanggalakhir: endDate
            },
            success: function (data) {
                // Update the content of the "filteredData" container
                $('#filteredData').html(data);
            },
            error: function (error) {
                console.log(error);
            }
        });
    });

    // Initial load to display data based on default date inputs (if needed)
    // Trigger the input event to load data based on default date inputs
    $('#tanggalawal, #tanggalakhir').trigger('input');
});

</script>
<!-- /.container-fluid -->
@endsection
