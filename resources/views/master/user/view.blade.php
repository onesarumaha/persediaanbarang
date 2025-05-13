@extends('layout.main')
@section('title', $title)

@section('content')
    <div class="col-md-12">
        <div class="card mt-4 shadow">
            <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ $title }}</h5>
                <div class="d-flex gap-2">
                    <a href="{{ url('/user') }}" class="btn btn-sm btn-danger">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali
                    </a>
                    <a href="{{ url('/user/' . $data->id . '/edit') }}" class="btn btn-sm btn-warning">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                </div>
            </div>

            <div class="card-body">
                <table class="table table-bordered table-striped table-hover">
                    <tr>
                        <th>Nama</th>
                        <td>{{ $data->name }}</td>
                    </tr>
                    <tr>
                        <th>Username</th>
                        <td>{{ $data->username }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $data->email }}</td>
                    </tr>
                    <tr>
                        <th>Divisi</th>
                        <td>{{ $data->role }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection


