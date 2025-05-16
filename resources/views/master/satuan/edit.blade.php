@extends('layout.main')
@section('title', 'Create Satuan')

@section('content')
    <div class="col-md-12">
        <div class="card mt-4 shadow">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Form Satuan</h5>
                <a href="{{ url('/satuan') }}" class="btn btn-light btn-sm" data-toggle="tooltip" title="Kembali ke daftar">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
            <div class="card-body">
                <form action="{{ route('satuan.update', $data->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="satuan">Satuan</label>
                        <input type="text" class="form-control" id="satuan" name="satuan"
                            value="{{ $data->satuan }}" required>
                    </div>
                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="reset" class="btn btn-outline-secondary">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
