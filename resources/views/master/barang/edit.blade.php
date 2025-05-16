@extends('layout.main')
@section('title', $title)

@section('content')
    <div class="row">
        <div class="col">
            <div class="card mt-4 shadow">

                <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                    <h5 class="card-title">Edit Barang</h5>
                    <a href="{{ url('/barang') }}" class="btn btn-secondary btn-sm" data-toggle="tooltip">
                        <span class="icon text-white-50">
                            <i class="fas fa-arrow-left"></i>
                        </span>
                        Kembali</a>
                </div>
                <div class="card-body">
                    <form action="{{ url('/barang/' . $data->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group p-2 mt-2">
                                    <label for="kode_barang">Kode Barang</label>
                                    <input type="text" class="form-control" id="kode_barang" name="kode_barang"
                                        value="{{ $data->kode_barang }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group p-2 mt-2">
                                    <label for="nama_barang">Nama Barang</label>
                                    <input type="text" class="form-control" id="nama_barang" name="nama_barang"
                                        value="{{ $data->nama_barang }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group p-2 mt-2">
                                    <label for="satuan">Satuan</label>
                                    <select class="form-control" id="satuan" name="satuan" required>
                                        <option value="" disabled selected>-- Pilih Satuan --</option>
                                        @foreach (['pcs', 'kg', 'liter', 'box'] as $satuan)
                                            <option value="{{ $satuan }}">{{ ucfirst($satuan) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group p-2 mt-2">
                                    <label for="harga">Harga</label>
                                    <input type="number" class="form-control" id="harga" name="harga"
                                        value="{{ $data->harga }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group p-2 mt-2">
                                    <label for="stok">Stok</label>
                                    <input type="number" class="form-control" id="stok" name="stok"
                                        value="{{ $data->stok }}" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group p-2 mt-2">
                                    <label class="text-primary">Deskripsi</label>
                                    <textarea type="text" name="deskripsi" class="form-control mt-2 p-2">{{ $data->deskripsi }}</textarea>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
