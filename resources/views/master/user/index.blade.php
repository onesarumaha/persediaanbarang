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
                            <th>#</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Divisi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    @foreach($data as $index => $user) 
                    <tbody>
                        <tr>
                            <td>{{$data->firstItem() + $index}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->username}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->role}}</td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                        data-toggle="dropdown">
                                        Action
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ url('/user/' . $user->id . '/edit') }}">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ url('/user/' . $user->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item"
                                                onclick="return confirm('Are you sure?')">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>

                                        <a class="dropdown-item" href="{{ url('/user/view/' . $user->id) }}">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
            <div class="justify-content-end">
                {{ $data->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
