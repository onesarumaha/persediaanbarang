@extends('layout.main')
@section('title', 'Dashboard')
@section('title', $title)


@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ $title }}</h5>
                <a href="{{ url('/barang/create') }}" class="btn btn-success btn-sm" data-toggle="tooltip">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    Tambah
                </a>
            </div>
            <div class ="card-body">
                <div class="table-responsive">
                    <form action="{{ url('/barang') }}" method="GET" class="form-inline mb-3">
                        <input type="text" name="search" class="form-control mr-2" placeholder="Cari barang..."
                            value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </form>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Satuan</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Stok</th>
                                <th scope="col">Deskripsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_barang }}</td>
                                    <td>{{ $item->satuan }}</td>
                                    <td>{{ $item->harga }}</td>
                                    <td>{{ $item->stok }}</td>
                                    <td>{{ $item->deskripsi }}</td>
                                    <td><span class="badge badge-primary">{{ $item->status }}</span></td>
                                    <td>
                                        <div class="btn-group mb-2 mr-2">
                                            <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button"
                                                data-toggle="dropdown">
                                                <i>Action</i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item"
                                                    href="{{ url('/barang/' . $item->id . '/edit') }}">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <a class="dropdown-item" href="{{ url('/barang/' . $item->id) }}">
                                                    <i class="fas fa-eye"></i> View
                                                </a>
                                                <form action="{{ url('/barang/' . $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item"
                                                        onclick="return confirm('Are you sure?')">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="justify-content-end mt-2">
                        {{ $data->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
