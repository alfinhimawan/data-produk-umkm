@extends('admin.layouts.app')

@section('title', 'Manajemen UMKM')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manajemen UMKM</h1>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-pill shadow-sm px-4 py-3 d-flex align-items-center"
            role="alert" style="font-size:1.05rem;">
            <i class="fas fa-check-circle fa-lg mr-3"></i> <span>{{ session('success') }}</span>
            <button type="button" class="close ml-auto" data-dismiss="alert" aria-label="Close" style="outline:none;">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show rounded-pill shadow-sm px-4 py-3 d-flex align-items-center"
            role="alert" style="font-size:1.05rem;">
            <i class="fas fa-times-circle fa-lg mr-3"></i> <span>{{ session('error') }}</span>
            <button type="button" class="close ml-auto" data-dismiss="alert" aria-label="Close" style="outline:none;">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show rounded shadow-sm px-4 py-3" role="alert"
            style="font-size:1.05rem;">
            <div class="d-flex align-items-center mb-2"><i class="fas fa-exclamation-triangle fa-lg mr-2"></i>
                <strong>Validasi Gagal</strong>
            </div>
            <ul class="mb-0 pl-4">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="outline:none;">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar UMKM</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pemilik</th>
                            <th>Nama Usaha</th>
                            <th>Alamat</th>
                            <th>Nomor WA</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($umkmProfiles as $index => $umkm)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $umkm->user->name ?? '-' }}</td>
                                <td>{{ $umkm->nama_umkm }}</td>
                                <td>{{ $umkm->alamat }}</td>
                                <td>{{ $umkm->kontak }}</td>
                                <td>
                                    @if ($umkm->status === 'aktif')
                                        <span class="badge badge-success">Aktif</span>
                                    @else
                                        <span class="badge badge-danger">Nonaktif</span>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('umkm-profiles.destroy', $umkm->id_umkm) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm btn-hapus-umkm"
                                            title="Hapus"><i class="fas fa-trash"></i></button>
                                    </form>
                                    @if ($umkm->status === 'aktif')
                                        <form action="{{ route('umkm-profiles.update', $umkm->id_umkm) }}" method="POST"
                                            style="display:inline-block;">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="nonaktif">
                                            <button type="submit" class="btn btn-warning btn-sm" title="Nonaktifkan"><i
                                                    class="fas fa-user-slash"></i></button>
                                        </form>
                                    @else
                                        <form action="{{ route('umkm-profiles.update', $umkm->id_umkm) }}" method="POST"
                                            style="display:inline-block;">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="aktif">
                                            <button type="submit" class="btn btn-success btn-sm" title="Aktifkan"><i
                                                    class="fas fa-user-check"></i></button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.table').DataTable();
            $('.btn-hapus-umkm').on('click', function(e) {
                e.preventDefault();
                var form = $(this).closest('form');
                Swal.fire({
                    title: 'Hapus UMKM?',
                    text: 'Data UMKM akan dihapus permanen!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
            setTimeout(function() {
                $(".alert").alert("close");
            }, 2500);
        });
    </script>
@endpush
