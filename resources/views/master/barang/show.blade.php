@extends('layout.main')
@section('title', $title)

@section('content')
<div class="col-md-12">
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
                aria-controls="pills-home" aria-selected="true">Details Barang</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab"
                aria-controls="pills-profile" aria-selected="false">History Stock</a>
        </li>
    </ul>

    <div class="tab-content" id="pills-tabContent">
        <!-- Tab Details Barang -->
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="card shadow">
                <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ $title }}</h5>
                    <a href="{{ url('/barang') }}" class="btn btn-sm btn-light">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped table-hover">
                        <tr>
                            <th>Nama Barang</th>
                            <td>{{ $data->nama_barang }}</td>
                        </tr>
                        <tr>
                            <th>Harga</th>
                            <td>Rp {{ number_format($data->harga, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Stok</th>
                            <td>{{ $data->stok }}</td>
                        </tr>
                        <tr>
                            <th>Satuan</th>
                            <td>{{ $data->satuan }}</td>
                        </tr>
                        <tr>
                            <th>Deskripsi</th>
                            <td>{{ $data->deskripsi ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Tab History Stock -->
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="card shadow">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">History Stok Barang</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped table-hover">
                        <tr>
                            <th>Stock Awal</th>
                            <th>Quantity</th>
                            <th>Stock Akhir</th>
                            <th>Keterangan</th>
                            <th>Waktu</th>
                        </tr>
                        @foreach($history as $item)
                        <tr>
                            <td>{{$item->stock_awal}} </td>
                            <td>{{$item->quantity}} </td>
                            <td>{{$item->stock_akhir}} </td>
                            <td>{{$item->note}} </td>
                            <td>{{$item->created_at}} </td>
                            
                        </tr>
                        @endforeach
                    </table>
                    <div class="justify-content-end mt-2">
                        {{ $history->links() }}
                    </div>
                </div>
               
            </div>
        </div>
    </div>
</div>
@endsection
