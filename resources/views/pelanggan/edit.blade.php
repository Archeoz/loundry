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
                            <h1 class="h4 text-gray-900 mb-4">Edit Data Member</h1>
                        </div>
                        <form class="user" action="{{ url('laundry/updatemember/'.$member->id_member) }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="form-group">
                                <div class=" mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user" id="exampleFirstName" value="{{ $member->nama_member }}" name="nama"
                                        placeholder="Insert Nama">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class=" mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user" id="exampleFirstName" value="{{ $member->alamat }}" name="alamat"
                                        placeholder="Insert Alamat">
                                </div>
                            </div>
                            <div class="form-group">
                                <select class="form-control form-control-select" name="jeniskelamin" id="exampleSelect" placeholder="Select Option" style="border-radius: 20px;height:50px;">
                                    <option value="{{ $member->jeniskelamin }}" selected>{{ $member->jeniskelamin }}</option>
                                    <option value="L">Laki-Laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <div class=" mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user" id="exampleFirstName" value="{{ $member->telp }}" name="telp"
                                        placeholder="Insert No Telp">
                                </div>
                            </div>
                            <a class="btn btn-primary btn-user btn-block" data-toggle="modal" data-target="#update">
                                Update Member
                            </a>
                            <div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Apakah Anda Yakin Update Akun</h5>
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
