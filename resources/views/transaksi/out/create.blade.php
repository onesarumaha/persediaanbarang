@extends('layout.main')

@section('title', 'Dashboard')

@section('content')
<div class="col-md-12">
    <div class="row">
        <div class="col-sm-12">
            <form action="{{route('barang-keluar.store')}}" method="POST" id="form-barang">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h5>Barang Keluar</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tanggal">Tanggal</label>
                                    <input type="date" class="form-control" name="tanggal">
                                    @if ($errors->has("tanggal")) 
                                        @foreach($errors->get("tanggal") as $key => $message)
                                        <div class="text-danger"><small>{{ $message }}</small></div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="type">Dibuat oleh </label>
                                    <input type="text" class="form-control" placeholder="{{ Auth::user()->name }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    <textarea class="form-control" rows="3" name="deskripsi"></textarea>
                                    @if ($errors->has("deskripsi")) 
                                        @foreach($errors->get("deskripsi") as $key => $message)
                                        <div class="text-danger"><small>{{ $message }}</small></div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Barang Item</h5>
                        <button type="button" class="btn btn-primary btn-sm btn-add"><b>Tambah</b></button>
                    </div>
                    <div class="card-body">
                        <div class="item-wrapper">
                            <div class="row item-group mb-2">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Nama Barang</label>
                                        <select class="form-control" name="barang_items[0][barang_id]">
                                            <option>-- Pilih Barang --</option>
                                            @foreach($data as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama_barang }}</option>
                                            @endforeach
                                        </select>
                                        @error('barang_items.0.barang_id')
                                            <div class="text-danger"><small>{{ $message }}</small></div>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Stock</label>
                                        <input type="text" class="form-control stock-input" readonly>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Quantity</label>
                                        <input type="text" class="form-control" name="barang_items[0][quantity]">
                                        @error('barang_items.0.quantity')
                                            <div class="text-danger"><small>{{ $message }}</small></div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Deskripsi</label>
                                        <textarea class="form-control" rows="1" name="barang_items[0][deskripsi]"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-end mb-3">
                                    <button type="button" class="btn btn-danger btn-sm btn-remove"><b>Hapus</b></button>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    let index = 1;

    $(document).on('click', '.btn-add', function () {
        let template = `
        <div class="row item-group mb-2">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Nama Barang</label>
                    <select class="form-control" name="barang_items[${index}][barang_id]">
                        <option>-- Pilih Barang --</option>
                        @foreach($data as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_barang }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Stock</label>
                    <input type="text" class="form-control stock-input" readonly>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Quantity</label>
                    <input type="text" class="form-control" name="barang_items[${index}][quantity]">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea class="form-control" rows="1" name="barang_items[${index}][deskripsi]"></textarea>
                </div>
            </div>
            <div class="col-md-2 d-flex align-items-end mb-3">
                <button type="button" class="btn btn-danger btn-sm btn-remove"><b>Hapus</b></button>
            </div>
        </div>
        `;
        $('.item-wrapper').append(template);
        index++;
    });

    $(document).on('click', '.btn-remove', function () {
        $(this).closest('.item-group').remove();
    });


    function updateStock(selectElement) {
        let barangId = $(selectElement).val();
        let stockInput = $(selectElement).closest('.item-group').find('.stock-input');

        if (barangId) {
            $.get(`/barang/${barangId}/stock`, function (data) {
                stockInput.val(data.stock);
            });
        } else {
            stockInput.val('');
        }
    }

    $(document).on('change', 'select[name^="barang_items"]', function () {
        updateStock(this);
    });

    $(document).on('click', '.btn-add', function () {
        $('.item-wrapper').append(template);
        index++;
    });

    $('#form-barang').on('submit', function(e) {
    let isValid = true;
    let errorMessage = '';

    $('.is-invalid').removeClass('is-invalid');
    $('.text-danger.js-error').remove();

    let tanggal = $('input[name="tanggal"]');
    if (!tanggal.val()) {
        tanggal.addClass('is-invalid');
        tanggal.after('<div class="text-danger js-error"><small>Tanggal wajib diisi.</small></div>');
        isValid = false;
    }


    $('.item-group').each(function(i, el) {
        let barang = $(el).find('select[name^="barang_items"]');
        let quantity = $(el).find('input[name^="barang_items"][name$="[quantity]"]');

        if (!barang.val()) {
            barang.addClass('is-invalid');
            barang.after('<div class="text-danger js-error"><small>Barang wajib dipilih.</small></div>');
            isValid = false;
        }

        if (!quantity.val() || isNaN(quantity.val()) || parseInt(quantity.val()) <= 0) {
            quantity.addClass('is-invalid');
            quantity.after('<div class="text-danger js-error"><small>Quantity harus angka dan lebih dari 0.</small></div>');
            isValid = false;
        }
    });

    if (!isValid) {
        e.preventDefault(); 
    }
});

</script>
@endsection
