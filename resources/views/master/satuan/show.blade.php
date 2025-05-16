@extends('layout.main')
@section('title', $title)

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
                <table class="table table-bordered table-striped table-hover">
                    <tr>
                        <td>{{ $data->satuan }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
