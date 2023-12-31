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
                            <h1 class="h4 text-gray-900 mb-4">Register User</h1>
                        </div>
                        <form class="user" action="{{ url('laundry/registeruser') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="nama" class="form-control form-control-user" id="exampleInputEmail" name="nama"
                                    placeholder="Name">
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user" id="exampleFirstName" name="username"
                                        placeholder="UserName">
                                </div>
                                <div class="col-sm-6">
                                    <select class="form-control form-control-select" name="outlet" id="exampleSelect" placeholder="Select Option" style="border-radius: 20px;height:50px;">
                                        <option value="" disabled selected>Outlet</option>
                                        @foreach ( $outlet as $row )
                                            <option value="{{ $row->id_outlet }}">{{ $row->nama_outlet }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control form-control-user" id="exampleInputEmail" name="email"
                                    placeholder="Email">
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user" name="password"
                                    id="exampleInputPassword" placeholder="Password">
                                </div>
                                <div class="col-sm-6">
                                    <select class="form-control form-control-select" name="role" id="exampleSelect" placeholder="Select Option" style="border-radius: 20px;height:50px;">
                                        <option value="" disabled selected>Jabatan</option>
                                        <option value="kasir">Kasir</option>
                                        <option value="owner">Owner</option>
                                    </select>
                                </div>
                            </div>
                            <a class="btn btn-primary btn-user btn-block" data-toggle="modal" data-target="#registeruser">
                                Register Account
                            </a>
                            <div class="modal fade" id="registeruser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Apakah Anda Yakin Membuat Akun</h5>
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
