@extends('admin.layouts.app')

@section('title', 'Laporan Produk')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Laporan Produk</h1>
</div>

<!-- Filter Laporan -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Filter Laporan</h6>
    </div>
    <div class="card-body">
        <form class="form-inline mb-3">
            <div class="form-group mr-3">
                <label for="filter_kategori" class="mr-2">Kategori</label>
                <select class="form-control" id="filter_kategori">
                    <option value="" selected>Semua Kategori</option>
                    <option value="Makanan">Makanan</option>
                    <option value="Minuman">Minuman</option>
                    <option value="Kerajinan">Kerajinan</option>
                </select>
            </div>
            <div class="form-group mr-3">
                <label for="filter_umkm" class="mr-2">UMKM</label>
                <select class="form-control" id="filter_umkm">
                    <option value="" selected>Semua UMKM</option>
                    <option value="UMKM Sari Rasa">UMKM Sari Rasa</option>
                    <option value="UMKM Pisang Jaya">UMKM Pisang Jaya</option>
                </select>
            </div>
            <button type="button" class="btn btn-primary"><i class="fas fa-filter mr-1"></i> Filter</button>
            <button type="button" class="btn btn-success ml-2"><i class="fas fa-file-excel mr-1"></i> Export Excel</button>
        </form>
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>UMKM</th>
                        <th>Harga</th>
                        <th>Status UMKM</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Contoh data statis -->
                    <tr>
                        <td>1</td>
                        <td>Kue Lapis Legit</td>
                        <td>Makanan</td>
                        <td>UMKM Sari Rasa</td>
                        <td>Rp 50.000</td>
                        <td><span class="badge badge-success">Aktif</span></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Keripik Pisang</td>
                        <td>Makanan</td>
                        <td>UMKM Pisang Jaya</td>
                        <td>Rp 20.000</td>
                        <td><span class="badge badge-danger">Nonaktif</span></td>
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
