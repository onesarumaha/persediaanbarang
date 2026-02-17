@extends('layout.main')
@section('title', 'Tambah Laporan')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">{{ $title }}</h5>
            <a href="{{ url('/laporan') }}" class="btn btn-secondary btn-sm" data-toggle="tooltip">Kembali</a>
        </div>
        <div class="card-body">
            <form action="{{ url('/laporan') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="no_transaksi">Nama Laporan</label>
                    <input type="text" name="no_transaksi" id="no_transaksi" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="TR-PENDING">Pending</option>
                        <option value="TR-DONE">Selesai</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
            </form>
        </div>
    </div>
</div>
@endsection
