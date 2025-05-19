@extends('layout.main')
@section('title', 'Create Barang')

@section('content')
    <div class="col-md-12">
        <div class="card mt-4 shadow">
            <div class="card-header text-white d-flex justify-content-between align-items-center">
                <h5 class="card-title">Input Barang</h5>
                <a href="{{ url('/barang') }}" class="btn btn-secondary btn-sm" data-toggle="tooltip">
                    <span class="icon text-white-50">
                        <i class="fas fa-arrow-left"></i>
                    </span>
                    Kembali</a>
            </div>
            <div class="card-body">
                <form action="{{ route('barang.index') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group p-2 mt-2">
                                <label for="kode_barang">Kode Barang</label>
                                <input type="text" class="form-control" id="kode_barang" name="kode_barang" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group p-2 mt-2">
                                <label for="nama_barang">Nama Barang</label>
                                <input type="text" class="form-control" id="nama_barang" name="nama_barang" required>
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
                                <input type="number" class="form-control" id="harga" name="harga" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group p-2 mt-2">
                                <label for="stok">Stok</label>
                                <input type="number" class="form-control" id="stok" name="stok" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group p-2 mt-2">
                                <label class="text-primary">Deskripsi</label>
                                <textarea type="text" name="deskripsi" class="form-control mt-2 p-2"></textarea>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                    <button type="reset" class="btn btn-sm btn-danger">Reset</button>
                </form>

            </div>
        </div>
    </div>

@endsection
