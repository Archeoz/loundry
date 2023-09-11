@extends('index')
@section('content')
<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row justify-content-center">

                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Edit Paket</h1>
                        </div>
                        <form class="user" action="{{ url('laundry/updatepaket/'.$paket->id_paket) }}" enctype="multipart/form-data" method="POST">
                            @csrf

                            <div class="form-group">
                                <div class="mb-3 mb-sm-0">
                                    <select class="form-control form-control-select" name="jenis" id="exampleSelect" placeholder="Select Option" style="border-radius: 20px;height:50px;">
                                        <option value="{{ $paket->jenis }}" selected>{{ $paket->jenis }}</option>
                                        <option value="kiloan">Kiloan</option>
                                        <option value="selimut">Selimut</option>
                                        <option value="bed_cover">Bed Cover</option>
                                        <option value="kaos">Kaos</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user" id="exampleFirstName" name="nama" value="{{ $paket->nama_paket }}"
                                        placeholder="Insert Nama Paket">
                                </div>
                                <div class="col-md-6 mb-3 mb-sm-0">
                                    <input type="number" class="form-control form-control-user" id="exampleFirstName" name="harga" value="{{ $paket->harga }}"
                                        placeholder="Insert Harga">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class=" mb-3 mb-sm-0">
                                    <select class="form-control form-control-select" name="outlet" id="exampleSelect" placeholder="Select Option" style="border-radius: 20px;height:50px;">
                                        <option value="" disabled selected>Outlet</option>
                                        @foreach ($outlet as $outlet)
                                        <option selected{{ $outlet->id_outlet == $paket->id_outlet }} value="{{ $outlet->id_outlet }}">{{ $outlet->nama }}</option>
                                        {{-- <option @if ($outlet->id_outlet == $paket->id_outlet)selected @endif value="{{ $outlet->id_outlet }}">{{ $outlet->nama }}</option> --}}
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <a class="btn btn-primary btn-user btn-block" data-toggle="modal" data-target="#registerpaket">
                                Register Account
                            </a>
                            <div class="modal fade" id="registerpaket" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Apakah Anda Yakin Ingin Memasukkan Paket</h5>
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
