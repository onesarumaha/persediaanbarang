@extends('layout.main')
@section('title', 'Laporan')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ $laporans['title'] }}</h1>
        </div>

        @if (session()->has('dataSession'))
            @if (session('dataSession')->status == 'success')
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    {{ session('dataSession')->message }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if (session('dataSession')->status == 'failed')
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('dataSession')->message }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        @endif

        <div class="row">
            <div class="col-sm-12 col-lg-6">
                <!-- Collapsable Card Example -->
                <div class="card shadow mb-4">
                    <!-- Card Header - Accordion -->
                    <a href="#formReport" class="d-block card-header py-3" data-toggle="collapse" role="button"
                        aria-expanded="true" aria-controls="formReport">
                        <h6 class="m-0 font-weight-bold text-primary">Form Laporan Data</h6>
                    </a>
                    <!-- Card Content - Collapse -->
                    <div class="collapse show" id="formReport">
                        <div class="card-body">
                            <form>
                                <div class="form-group row align-items-center">
                                    <label class="col-sm-3 col-form-label ">What data is needed?</label>
                                    <div class="col-sm-9">
                                        <select wire:model.live='laporans.data' type="text" class="form-control"
                                            {{ $laporans['data'] ? 'disabled' : '' }}>
                                            <option value="">--Select data--</option>
                                            <option value="in">Barang Masuk</option>
                                            <option value="out">Barang Keluar</option>
                                    </div>
                                </div>

                                {{-- Jika filter sudah dipilih, ini akan muncul --}}
                                @if ($laporans['filter'] === 'barang_masuk' && $filterBy)
                                    <div class="card mt-3">
                                        <div class="card-body">
                                            <h5>Data Barang Masuk ({{ ucfirst($filterBy) }})</h5>
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Nama Barang</th>
                                                        <th>Jumlah</th>
                                                        <th>Tanggal Masuk</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($laporans['data'] as $barang)
                                                        <tr>
                                                            <td>{{ $barang['nama_barang'] }}</td>
                                                            <td>{{ number_format($barang['jumlah']) }}</td>
                                                            <td>{{ $barang['tanggal'] }}</td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="3">Tidak ada data barang masuk.</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endif

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
