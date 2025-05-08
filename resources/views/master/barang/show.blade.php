@extends('layout.main')
@section('title', $title)

@section('content')
    <div class="col-md-12">
        <div class="card mt-4 shadow">
            <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ $title }}</h5>
                <a href="{{ url('/barang') }}" class="btn btn-sm btn-light">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali
                </a>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover">
                    <tr>
                        <th>Nama Barang</th>
                        <td>{{ $data->nama_barang }}</td>
                    </tr>
                    <tr>
                        <th>Harga</th>
                        <td>Rp {{ number_format($data->harga, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Stok</th>
                        <td>{{ $data->stok }}</td>
                    </tr>
                    <tr>
                        <th>Satuan</th>
                        <td>{{ $data->satuan }}</td>
                    </tr>
                    <tr>
                        <th>Deskripsi</th>
                        <td>{{ $data->deskripsi ?? '-' }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection


