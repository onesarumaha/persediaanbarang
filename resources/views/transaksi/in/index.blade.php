
@extends('layout.main')

@section('title', 'Dashboard')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">{{ $title }}</h5>
            <a href="{{ url('/user/create') }}" class="btn btn-primary btn-sm" data-toggle="tooltip">Tambah</a>
        </div>
        <div class="card-body table-border-style">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Harga</th>
                            <th>Satuan</th>
                            <th>Stok</th>
                            <th>Deskripsi</th>
                        </tr>
                    </thead>
                    @foreach ($data as $item)
                    <tbody>
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama_barang }}</td>
                            <td>{{ $item->harga }}</td>
                            <td>{{ $item->satuan }}</td>
                            <td>{{ $item->stok }}</td>
                            <td>{{ $item->deskripsi }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
