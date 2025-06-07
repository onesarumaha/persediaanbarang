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
<form action="{{ route('stock-opname.approve', ['id' => $data->id]) }}" method="POST" style="display:inline;">
    @csrf
    <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Approve data ini?')">
        <i class="fas fa-check"></i> Approve
    </button>
</form>

                    <a href="{{ url('/stock-opname') }}" class="btn btn-sm btn-danger">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali
                    </a>
                    <a href="{{ route('stock-opname.edit', ['stock_opname' => $data->id]) }}" class="btn btn-sm btn-warning">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                </li>
            </ul>

          
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <table class="table table-bordered table-striped table-hover">
                        <tr>
                            <th>No Transaksi</th>
                            <td>{{ $data->no_opname }}</td>
                        </tr>
                        <tr>
                            <th>Deskripsi</th>
                            <td>{{ $data->deskripsi ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td> 
                                <span class="badge badge-pill {{ $data->status === 'OP-DONE' ? 'badge-success' : 'badge-warning' }}">
                                    {{ $data->status === 'OP-DONE' ? 'Selesai' : 'Pending' }}
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
                        @foreach($data->stockOpnameItems as $item)
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
