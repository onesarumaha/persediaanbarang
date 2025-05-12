@extends('layout.main')

@section('title', 'Dashboard')

@section('content')
<div class="col-md-12">
    <div class="row">
        <div class="col-sm-12">
            <form action="{{route('barang-keluar.update',  $transaksi->id)}}" method="POST" id="form-barang">
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
                                    <input type="date" class="form-control" name="tanggal" value="{{ old('tanggal', $transaksi->tanggal) }}">
                                    @if ($errors->has("tanggal")) 
                                        @foreach($errors->get("tanggal") as $key => $message)
                                        <div class="text-danger"><small>{{ $message }}</small></div>
                                        @endforeach
                                    @endif
                                </div>
                                
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="type">Dibuat oleh </label>
                                    <input type="text" class="form-control" placeholder="{{ Auth::user()->name }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    <textarea class="form-control" rows="3" name="deskripsi">{{ old('deskripsi', $transaksi->deskripsi) }}</textarea>
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
                            @forelse($transaksiItems as $index => $item)
                                <div class="row item-group mb-2">
                                    <input type="hidden" name="barang_items[{{ $index }}][id]" value="{{ $item->id }}" />
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Nama Barang</label>
                                            <select class="form-control select-barang" name="barang_items[{{ $index }}][barang_id]">
                                                <option value="">-- Pilih Barang --</option>
                                                @foreach($data as $barang)
                                                    <option value="{{ $barang->id }}" {{ old('barang_items.'.$index.'.barang_id', $item->barang_id) == $barang->id ? 'selected' : '' }}>{{ $barang->nama_barang }}</option>
                                                @endforeach
                                            </select>
                                            @error('barang_items.'.$index.'.barang_id')
                                                <div class="text-danger"><small>{{ $message }}</small></div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Stock</label>
                                            <input type="text" class="form-control stock-input" readonly style="padding: 0.2rem 0.4rem; font-size: 15px; height: 30px; line-height: 1.2;" value="{{ $item->barang->stock ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Quantity</label>
                                            <input type="text" class="form-control quantity-input" name="barang_items[{{ $index }}][quantity]" value="{{ old('barang_items.'.$index.'.quantity', $item->quantity) }}" style="padding: 0.2rem 0.4rem; font-size: 15px; height: 30px; line-height: 1.2;">
                                            @error('barang_items.'.$index.'.quantity')
                                                <div class="text-danger"><small>{{ $message }}</small></div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Note</label>
                                            <textarea class="form-control" rows="0" name="barang_items[{{ $index }}][deskripsi]" style="padding: 0.2rem 0.4rem; font-size: 15px; height: 30px; line-height: 1.2;">{{ old('barang_items.'.$index.'.deskripsi', $item->deskripsi) }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-2 d-flex align-items-end mb-3">
                                        <button type="button" class="btn btn-danger btn-sm btn-remove"><b>Hapus</b></button>
                                    </div>
                                    <input type="hidden" name="barang_items[{{ $index }}][id]" value="{{ $item->id }}">
                                </div>
                            @empty
                                <div class="row item-group mb-2">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Nama Barang</label>
                                            <select class="form-control select-barang" name="barang_items[0][barang_id]">
                                                <option value="">-- Pilih Barang --</option>
                                                @foreach($data as $barang)
                                                    <option value="{{ $barang->id }}" {{ old('barang_items.0.barang_id') == $barang->id ? 'selected' : '' }}>{{ $barang->nama_barang }}</option>
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
                                            <input type="text" class="form-control stock-input" readonly style="padding: 0.2rem 0.4rem; font-size: 15px; height: 30px; line-height: 1.2;">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Quantity</label>
                                            <input type="text" class="form-control quantity-input" name="barang_items[0][quantity]" value="{{ old('barang_items.0.quantity') }}" style="padding: 0.2rem 0.4rem; font-size: 15px; height: 30px; line-height: 1.2;">
                                            @error('barang_items.0.quantity')
                                                <div class="text-danger"><small>{{ $message }}</small></div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Note</label>
                                            <textarea class="form-control" rows="0" name="barang_items[0][deskripsi]" style="padding: 0.2rem 0.4rem; font-size: 15px; height: 30px; line-height: 1.2;">{{ old('barang_items.0.deskripsi') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-2 d-flex align-items-end mb-3">
                                        <button type="button" class="btn btn-danger btn-sm btn-remove"><b>Hapus</b></button>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm mt-3">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    let index = 100;

    function createItemTemplate(index) {
        return `
        <div class="row item-group mb-2">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Nama Barang</label>
                    <select class="form-control select-barang" name="barang_items[${index}][barang_id]">
                        <option value="">-- Pilih Barang --</option>
                        @foreach($data as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_barang }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback"></div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Stock</label>
                    <input type="text" class="form-control stock-input" readonly style="padding: 0.2rem 0.4rem; font-size: 15px; height: 30px; line-height: 1.2;">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Quantity</label>
                    <input type="text" class="form-control quantity-input" name="barang_items[${index}][quantity]" style="padding: 0.2rem 0.4rem; font-size: 15px; height: 30px; line-height: 1.2;">
                    <div class="invalid-feedback"></div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Note</label>
                    <textarea class="form-control" rows="1" name="barang_items[${index}][deskripsi]" style="padding: 0.2rem 0.4rem; font-size: 15px; height: 30px; line-height: 1.2;"></textarea>
                </div>
            </div>
            <div class="col-md-2 d-flex align-items-end mb-3">
                <button type="button" class="btn btn-danger btn-sm btn-remove"><b>Hapus</b></button>
            </div>
        </div>
        `;
    }

    $(document).on('click', '.btn-add', function () {
        let template = createItemTemplate(index);
        $('.item-wrapper').append(template);
        
        let newSelect = $('.item-wrapper').find('.select-barang').last();
        newSelect.select2({
            placeholder: "-- Pilih Barang --",
            allowClear: true
        });
        
        newSelect.on('select2:select', function() {
            let container = $(this).closest('.form-group');
            $(this).removeClass('is-invalid');
            container.find('.text-danger.js-error').remove();
            updateStock(this);
        });
        
        index++;
    });

    $(document).on('click', '.btn-remove', function () {
        $(this).closest('.item-group').remove();
    });

    function updateStock(selectElement) {
        let barangId = $(selectElement).val();
        let stockInput = $(selectElement).closest('.item-group').find('.stock-input');

        if (barangId) {
            stockInput.val('');
            
            $.ajax({
                url: `/barang/${barangId}/stock`,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    stockInput.val(data.stock);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching stock:', error);
                    stockInput.val('Error loading stock');
                }
            });
        } else {
            stockInput.val('');
        }
    }

    $(document).on('select2:open', '.select-barang', function() {
        let container = $(this).closest('.form-group');
        $(this).removeClass('is-invalid');
        container.find('.text-danger.js-error').remove();
    });
    
    $(document).on('select2:select', '.select-barang', function() {
        let container = $(this).closest('.form-group');
        $(this).removeClass('is-invalid');
        container.find('.text-danger.js-error').remove();
        updateStock(this);
    });

    $(document).on('input', '.quantity-input', function() {
        $(this).removeClass('is-invalid');
        $(this).next('.text-danger.js-error').remove();
        
        let stockInput = $(this).closest('.item-group').find('.stock-input');
        let stock = parseInt(stockInput.val() || 0);
        let quantity = parseInt($(this).val() || 0);
        
        if (quantity > stock && stock > 0) {
            $(this).addClass('is-invalid');
            if ($(this).next('.text-danger.js-error').length === 0) {
                $(this).after(`<div class="text-danger js-error"><small>Quantity melebihi stock (${stock}).</small></div>`);
            }
        }
    });
    
    $('input[name="tanggal"]').on('input change', function() {
        $(this).removeClass('is-invalid');
        $(this).next('.text-danger.js-error').remove();
    });
    
    $('textarea[name="deskripsi"]').on('input', function() {
        $(this).removeClass('is-invalid');
        $(this).next('.text-danger.js-error').remove();
    });

    $('#form-barang').on('submit', function(e) {
        let isValid = true;
        
        $('.is-invalid').removeClass('is-invalid');
        $('.text-danger.js-error').remove();

        let tanggal = $('input[name="tanggal"]');
        if (!tanggal.val()) {
            tanggal.addClass('is-invalid');
            tanggal.after('<div class="text-danger js-error"><small>Tanggal wajib diisi.</small></div>');
            isValid = false;
        }

        $('.item-group').each(function(i, el) {
            let barangContainer = $(el).find('.select-barang').closest('.form-group');
            let barangSelect = $(el).find('.select-barang');
            let quantity = $(el).find('.quantity-input');
            let stockInput = $(el).find('.stock-input');
            let stock = parseInt(stockInput.val() || 0);

            if (!barangSelect.val()) {
                barangSelect.addClass('is-invalid');
                if (barangContainer.find('.text-danger.js-error').length === 0) {
                    barangContainer.append('<div class="text-danger js-error"><small>Barang wajib dipilih.</small></div>');
                }
                isValid = false;
            }

            if (!quantity.val() || isNaN(quantity.val()) || parseInt(quantity.val()) <= 0) {
                quantity.addClass('is-invalid');
                quantity.after('<div class="text-danger js-error"><small>Quantity harus angka dan lebih dari 0.</small></div>');
                isValid = false;
            } else if (parseInt(quantity.val()) > stock) {
                quantity.addClass('is-invalid');
                quantity.after(`<div class="text-danger js-error"><small>Quantity tidak boleh melebihi stock (${stock}).</small></div>`);
                isValid = false;
            }
        });

        if (!isValid) {
            e.preventDefault();
            
            $('.is-invalid').first().focus();
        }
    });

    $(document).ready(function () {
        $('.select-barang').select2({
            placeholder: "-- Pilih Barang --",
            allowClear: true
        }).on('select2:select', function() {
            let container = $(this).closest('.form-group');
            $(this).removeClass('is-invalid');
            container.find('.text-danger.js-error').remove();
            
            updateStock(this);
        });
        
        $('.select-barang').each(function() {
            if ($(this).val()) {
                updateStock(this);
            }
        });
    });

</script>
@endsection