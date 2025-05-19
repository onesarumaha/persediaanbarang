@extends('layout.main')

@section('title', 'Dashboard')

@section('content')
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ $title }}</h5>
                <a href="{{ url('/supplier/create') }}" class="btn btn-primary btn-sm" data-toggle="tooltip">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    Tambah</a>
            </div>
            <div class="card-body table-border-style">
                <form action="{{ url('/supplier') }}" method="GET" class="form-inline mb-3">
                    <input type="text" name="search" class="form-control mr-2" placeholder="Cari supplier..."
                        value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </form>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Supplier</th>
                                <th>Email</th>
                                <th>No Telepon</th>
                                <th>Alamat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_supplier }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->no_telp }}</td>
                                    <td>{{ $item->alamat }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                                data-toggle="dropdown">
                                                <i>Action</i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item"
                                                    href="{{ url('/supplier/' . $item->id . '/edit') }}">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <form action="{{ url('/supplier/' . $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item"
                                                        onclick="return confirm('Are you sure?')">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </button>
                                                </form>

                                                <a class="dropdown-item" href="{{ url('/supplier/' . $item->id) }}">
                                                    <i class="fas fa-eye"></i> View
                                                </a>
                                            </div>
                                        </div>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- Pagination --}}
                    <div class="justify-content-end">
                        {{ $data->appends(['search' => request('search')])->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
