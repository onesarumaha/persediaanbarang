@extends('layout.main')
@section('title', $title)

@section('content')
    <div class="row">
        <div class="col">
            <div class="card mt-4 shadow">

                <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                    <h5 class="card-title">Edit Supplier</h5>
                    <a href="{{ url('/supplier') }}" class="btn btn-secondary btn-sm" data-toggle="tooltip">
                        <span class="icon text-white-50">
                            <i class="fas fa-arrow-left"></i>
                        </span>
                        Kembali</a>
                </div>
                <div class="card-body">
                    <form action="{{ url('/supplier/' . $data->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group p-2 mt-2">
                                    <label for="nama_supplier">Nama Supplier</label>
                                    <input type="text" class="form-control" id="nama_supplier" name="nama_supplier"
                                        value="{{ $data->nama_supplier }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group p-2 mt-2">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ $data->email }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group p-2 mt-2">
                                    <label for="no_telp">No Telepon</label>
                                    <input type="tel" class="form-control" id="no_telp" name="no_telp"
                                        value="{{ $data->no_telp }}" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group p-2 mt-2">
                                    <label for="alamat">Alamat</label>
                                    <textarea class="form-control" id="alamat" name="alamat" rows="3"
                                        required>{{ $data->alamat }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                            <button type="reset" class="btn btn-danger btn-sm">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
