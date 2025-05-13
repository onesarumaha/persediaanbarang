@extends('layout.main')

@section('title', 'Dashboard')

@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <h5>{{$title}}</h5>
        </div>
        <form action="{{route('user.update', $data->id)}}" method="POST">
        @csrf
        @method('PUT')
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputnama">Nama</label>
                            <input type="text" class="form-control" id="exampleInputnama" aria-describedby="emailHelp" placeholder="Nama" name="name" value="{{ old('name', $data->name) }}">
                             @if ($errors->has("name")) 
                                @foreach($errors->get("name") as $key => $message)
                                <div class="text-danger"><small>{{ $message }}</small></div>
                                @endforeach
                            @endif
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email" name="email" value="{{ old('email', $data->email) }}">
                             @if ($errors->has("email")) 
                                @foreach($errors->get("email") as $key => $message)
                                <div class="text-danger"><small>{{ $message }}</small></div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputUsername">Username</label>
                            <input type="text" class="form-control" id="exampleInputUsername" aria-describedby="emailHelp" placeholder="Username" name="username" value="{{ old('username', $data->username) }}">
                            @if ($errors->has("username")) 
                                @foreach($errors->get("username") as $key => $message)
                                <div class="text-danger"><small>{{ $message }}</small></div>
                                @endforeach
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Divisi</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="role">
                                <option value="Admin" {{ old('role', $data->role) == 'Admin' ? 'selected' : '' }}>Admin Gudang</option>
                                <option value="Superadmin" {{ old('role', $data->role) == 'Superadmin' ? 'selected' : '' }}>Superadmin</option>
                            </select>
                            @error('role')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                       
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>

            </div>
        </form>

    </div>
  
</div>
                               
@endsection
