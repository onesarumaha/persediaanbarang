
@extends('layout.main')

@section('title', 'Dashboard')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">{{ $title }}</h5>
            <a href="{{ url('/barang-keluar/create') }}" class="btn btn-primary btn-sm" data-toggle="tooltip">Tambah</a>
        </div>
        <div class="card-body table-border-style">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Transaksi</th>
                            <th>Tanggal</th>
                            <th>Deskripsi</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    @foreach ($data as $item)
                    <tbody>
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->no_transaksi}}</td>
                            <td>{{$item->tanggal}}</td>
                            <td>{{$item->deskripsi}}</td>
                            <td>
                                <span class="badge badge-pill badge-success">
                                    {{ $item->status === 'TR-DONE' ? 'selesai' : $item->status }}
                                </span>
                            </td>
                            <td>
                                <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('barang-keluar.view', $item->id) }}">View</a>
                                    <a class="dropdown-item" href="{{ route('barang-keluar.edit', $item->id) }}">Update</a>
                                    <a class="dropdown-item" href="#!">Delete</a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
