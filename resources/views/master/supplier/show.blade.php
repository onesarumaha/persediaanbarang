@extends('layout.main')
@section('title', $title)

@section('content')
    <div class="col-md-12">
        <div class="card mt-4 shadow">
            <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ $title }}</h5>
                <a href="{{ url('/supplier') }}" class="btn btn-sm btn-light">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali
                </a>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover">
                    <tr>
                        <th>Nama Supplier</th>
                        <td>{{ $data->nama_supplier }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $data->email }}</td>
                    </tr>
                    <tr>
                        <th>No Telepon</th>
                        <td>{{ $data->no_telp }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>{{ $data->alamat }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection


