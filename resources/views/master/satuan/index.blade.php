@extends('layout.main')

@section('title', $title)
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
{{-- <script>
    $(document).ready(function() {
        $('.btn-delete').on('click', function(e) {
            e.preventDefault();
            let form = $(this).closest('form');

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script> --}}

@section('content')
    <div class="col-md-12">
        @if (session('success') || session('info') || session('danger') || session('warning') || session('error'))
            <script>
                Swal.fire({
                    icon: @if (session('success'))
                        'success'
                    @elseif (session('info'))
                        'info'
                    @elseif (session('danger'))
                        'warning'
                        {{-- ubah dari 'error' jadi 'warning' --}}
                    @elseif (session('error'))
                        'error'
                    @elseif (session('warning'))
                        'warning'
                    @endif ,
                    title: @if (session('success'))
                        'Berhasil'
                    @elseif (session('info'))
                        'Info'
                    @elseif (session('danger'))
                        'Berhasil'
                    @elseif (session('error'))
                        'Gagal'
                    @elseif (session('warning'))
                        'Peringatan'
                    @endif ,
                    text: "{{ session('success') ?? (session('info') ?? (session('danger') ?? (session('error') ?? session('warning')))) }}",
                    timer: 2000,
                    showConfirmButton: false
                });
            </script>
        @endif
        <div class="card">
            <div class="card-header text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ $title }}</h5>
                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#satuanModal">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    Satuan
                </button>

                <!-- Modal -->
                <div class="modal fade" id="satuanModal" tabindex="-1" role="dialog" aria-labelledby="satuanModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form action="{{ route('satuan.store') }}" method="POST">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header text-white">
                                    <h5 class="modal-title" id="satuanModalLabel">Tambah Satuan Barang</h5>
                                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="satuan" class="text-dark">Satuan</label>
                                        <input type="text" class="form-control" id="satuan" name="satuan"
                                            placeholder="Masukkan satuan barang" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ url('/satuan') }}" method="GET" class="form-inline mb-3">
                    <input type="text" name="search" class="form-control mr-2" placeholder="Cari satuan..."
                        value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </form>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Satuan</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->satuan }}</td>
                                    <td>
                                        <div class="btn-group mb-2 mr-2">
                                            <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button"
                                                data-toggle="dropdown">
                                                <i>Action</i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ url('/satuan/' . $item->id . '/edit') }}">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <a class="dropdown-item" href="{{ url('/satuan/' . $item->id) }}">
                                                    <i class="fas fa-eye"></i> View
                                                </a>
                                                <form action="{{ url('/satuan/' . $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item bt-delete">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="justify-content-end mt-2">
                        {{ $data->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
