@extends('layout.main')

@section('title', 'Dashboard')

@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <h5>{{$title}}</h5>
        </div>
        <form action="{{route('user.store')}}" method="POST">
        @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputnama">Nama</label>
                            <input type="text" class="form-control" id="exampleInputnama" aria-describedby="emailHelp" placeholder="Nama" name="name">
                             @if ($errors->has("name")) 
                                @foreach($errors->get("name") as $key => $message)
                                <div class="text-danger"><small>{{ $message }}</small></div>
                                @endforeach
                            @endif
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email" name="email">
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
                            <input type="text" class="form-control" id="exampleInputUsername" aria-describedby="emailHelp" placeholder="Username" name="username">
                            @if ($errors->has("username")) 
                                @foreach($errors->get("username") as $key => $message)
                                <div class="text-danger"><small>{{ $message }}</small></div>
                                @endforeach
                            @endif
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Divisi</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="role">
                                    <option value="Admin">Admin Gudang</option>
                                    <option value="Superadmin">Superadmin</option>
                                </select>
                            </div>
                        </div>
                       
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>

            </div>
        </form>

    </div>
  
</div>
                               
@endsection
