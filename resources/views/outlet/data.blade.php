@extends('index')

@section('content')
<div class="container">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data outlet</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List outlet</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Telp</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ( $outlet as $outlet )
                        <tr>
                            <td>{{ $no++ }}.</td>
                            <td>{{ $outlet->nama_outlet }}</td>
                            <td>{{ $outlet->alamat }}</td>
                            <td>{{ $outlet->telp }}</td>
                            <td class="">
                                <a href="{{ url('laundry/updateoutletpage/'.$outlet->id_outlet) }}" class="mr-2 text-warning" ><i class="fas fa-edit"></i></a>
                                <a href="" data-toggle="modal" data-target="#deleteuser{{ $outlet->id_outlet }}"  class="ml-2 text-danger"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                        <div class="modal fade" id="deleteoutlet" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-danger" id="exampleModalLabel">Apakah Anda Yakin Menghapus Outlet</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                            <a href="{{ url('laundry/deleteoutlet/'.$outlet->id_outlet) }}" type="submit" class="btn btn-danger">Yakin</a>
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
