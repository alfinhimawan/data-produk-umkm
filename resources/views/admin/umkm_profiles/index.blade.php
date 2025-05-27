@extends('admin.layouts.app')

@section('title', 'Manajemen UMKM')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Manajemen UMKM</h1>
</div>

<!-- Tabel UMKM -->
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
                    <tr>
                        <td>1</td>
                        <td>Ahmad Fauzi</td>
                        <td>UMKM Sari Rasa</td>
                        <td>Jl. Merdeka No. 10</td>
                        <td>08123456789</td>
                        <td><span class="badge badge-success">Aktif</span></td>
                        <td>
                            <a href="#" class="btn btn-success btn-sm" title="Aktifkan"><i class="fas fa-user-check"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Siti Aminah</td>
                        <td>UMKM Pisang Jaya</td>
                        <td>Jl. Kenanga No. 5</td>
                        <td>08987654321</td>
                        <td><span class="badge badge-danger">Nonaktif</span></td>
                        <td>
                            <a href="#" class="btn btn-danger btn-sm" title="Nonaktifkan"><i class="fas fa-user-check"></i></a>
                        </td>
                    </tr>
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
    });
</script>
@endpush
