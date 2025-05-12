@extends('layout.main')

@section('title', 'Dashboard')

@section('content')
<div class="col-md-12">
    <div class="row">
        <div class="col-sm-12">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Info</a>
                </li>
                <li class="nav-item ml-auto">
                    <a href="{{ url('/barang-keluar') }}" class="btn btn-sm btn-light">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali
                    </a>
                </li>
            </ul>

          
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <table class="table table-bordered table-striped table-hover">
                        <tr>
                            <th>No Transaksi</th>
                            <td>{{ $data->no_transaksi }}</td>
                        </tr>
                        <tr>
                            <th>Deskripsi</th>
                            <td>{{ $data->deskripsi ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td> 
                                <span class="badge badge-pill badge-success">
                                    {{  $data->status === 'TR-DONE' ? 'selesai' : $data->status  }}
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="tab-content" id="pills-tabContent">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Barang Item</h5>
                </div>
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <table class="table table-bordered table-striped table-hover">
                        <tr>
                            <th>Nama Barang</th>
                            <th>Quantity</th>
                            <th>Note</th>
                        </tr>
                        @foreach($data->barangKeluarItems as $item)
                        <tbody>
                            <td>{{$item->barang->nama_barang}}</td>
                            <td>{{$item->quantity}}</td>
                            <td>{{$item->deskripsi}}</td>
                        </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
