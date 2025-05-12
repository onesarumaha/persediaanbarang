@extends('layout.main')
@section('title', 'Create Supplier')

@section('content')
    <div class="col-md-12">
        <div class="card mt-4 shadow">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Form Input Supplier</h5>
                <a href="{{ url('/supplier') }}" class="btn btn-secondary btn-sm" data-toggle="tooltip"
                    title="Kembali ke daftar supplier">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
            <div class="card-body">
                {{-- Tampilkan pesan error validasi --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('supplier.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_supplier">Nama Supplier</label>
                                <input type="text" class="form-control" id="nama_supplier" name="nama_supplier"
                                    placeholder="Masukkan nama supplier" value="{{ old('nama_supplier')}}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="contoh@supplier.com" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telepon">No Telepon</label>
                                <input type="tel" class="form-control" id="no_telp" name="no_telp"
                                    placeholder="08xxxxxxxxxx" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="address">Alamat</label>
                                <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Masukkan alamat lengkap"
                                    required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                        <button type="reset" class="btn btn-danger btn-sm">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
