@extends('admin.layouts.app')

@section('title', 'Kategori Produk')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Kategori Produk</h1>
    <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalTambahKategori">
        <i class="fas fa-plus"></i> Tambah Kategori
    </a>
</div>

<!-- Tabel Kategori -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Kategori Produk</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Contoh data statis -->
                    <tr>
                        <td>1</td>
                        <td>Makanan</td>
                        <td>
                            <a href="#" class="btn btn-info btn-sm" title="Edit" data-toggle="modal" data-target="#modalEditKategori"><i class="fas fa-edit"></i></a>
                            <a href="#" class="btn btn-danger btn-sm" title="Hapus"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Minuman</td>
                        <td>
                            <a href="#" class="btn btn-info btn-sm" title="Edit" data-toggle="modal" data-target="#modalEditKategori"><i class="fas fa-edit"></i></a>
                            <a href="#" class="btn btn-danger btn-sm" title="Hapus"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Kerajinan</td>
                        <td>
                            <a href="#" class="btn btn-info btn-sm" title="Edit" data-toggle="modal" data-target="#modalEditKategori"><i class="fas fa-edit"></i></a>
                            <a href="#" class="btn btn-danger btn-sm" title="Hapus"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah Kategori -->
<div class="modal fade" id="modalTambahKategori" tabindex="-1" role="dialog" aria-labelledby="modalTambahKategoriLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalTambahKategoriLabel"><i class="fas fa-plus mr-2"></i>Tambah Kategori</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="nama_kategori">Nama Kategori</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-tag"></i></span>
                            </div>
                            <input type="text" class="form-control" id="nama_kategori" placeholder="Nama Kategori">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Kategori (dummy, isi sama dengan tambah) -->
<div class="modal fade" id="modalEditKategori" tabindex="-1" role="dialog" aria-labelledby="modalEditKategoriLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="modalEditKategoriLabel"><i class="fas fa-edit mr-2"></i>Edit Kategori</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="edit_nama_kategori">Nama Kategori</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-tag"></i></span>
                            </div>
                            <input type="text" class="form-control" id="edit_nama_kategori" value="Makanan">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-info">Update</button>
            </div>
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
