
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
                    @foreach ($data as $index => $item)
                    <tbody>
                        <tr>
                            <td>{{$data->firstItem() + $index}}</td>
                            <td>{{$item->no_transaksi}}</td>
                            <td>{{$item->tanggal}}</td>
                            <td>{{$item->deskripsi}}</td>
                            <td>
                                <span class="badge badge-pill badge-success">
                                    {{ $item->status === 'TR-DONE' ? 'selesai' : $item->status }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                        data-toggle="dropdown">
                                        Action
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ url('/barang-keluar/' . $item->id . '/edit') }}">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ url('/barang-keluar/' . $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item"
                                                onclick="return confirm('Are you sure?')">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>

                                        <a class="dropdown-item" href="{{ url('/barang-keluar/' . $item->id . '/view') }}">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
                {{ $data->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
