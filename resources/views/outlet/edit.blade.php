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
                            <h1 class="h4 text-gray-900 mb-4">Edit Data Outlet</h1>
                        </div>
                        <form class="user" action="{{ url('laundry/updateoutlet/'.$outlet->id_outlet) }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="form-group">
                                <div class=" mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user" id="exampleFirstName" value="{{ $outlet->nama_outlet }}" name="nama"
                                        placeholder="Insert Nama">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class=" mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user" id="exampleFirstName" value="{{ $outlet->alamat }}" name="alamat"
                                        placeholder="Insert Alamat">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class=" mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user" id="exampleFirstName" value="{{ $outlet->telp }}" name="telp"
                                        placeholder="Insert No Telp">
                                </div>
                            </div>
                            <a class="btn btn-primary btn-user btn-block" data-toggle="modal" data-target="#updateoutlet">
                                Update Outlet
                            </a>

                            <div class="modal fade" id="updateoutlet" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Apakah Anda Yakin Update Outlet</h5>
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
