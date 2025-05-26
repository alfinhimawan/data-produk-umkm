@extends('admin.layouts.app')

@section('title', 'Produk UMKM')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Produk UMKM</h1>
    <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalTambahProduk">
        <i class="fas fa-plus"></i> Tambah Produk
    </a>
</div>

<!-- Tabel Produk -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Produk UMKM</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>UMKM</th>
                        <th>Harga</th>
                        <th>Foto</th>
                        <th>Aksi</th>
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
                        <td><img src="{{ asset('img/produk1.jpg') }}" alt="Foto" class="img-thumbnail" width="60"></td>
                        <td>
                            <a href="#" class="btn btn-info btn-sm" title="Edit" data-toggle="modal" data-target="#modalEditProduk"><i class="fas fa-edit"></i></a>
                            <a href="#" class="btn btn-danger btn-sm" title="Hapus"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Keripik Pisang</td>
                        <td>Makanan</td>
                        <td>UMKM Pisang Jaya</td>
                        <td>Rp 20.000</td>
                        <td><img src="{{ asset('img/produk2.jpg') }}" alt="Foto" class="img-thumbnail" width="60"></td>
                        <td>
                            <a href="#" class="btn btn-info btn-sm" title="Edit" data-toggle="modal" data-target="#modalEditProduk"><i class="fas fa-edit"></i></a>
                            <a href="#" class="btn btn-danger btn-sm" title="Hapus"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah Produk -->
<div class="modal fade" id="modalTambahProduk" tabindex="-1" role="dialog" aria-labelledby="modalTambahProdukLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalTambahProdukLabel"><i class="fas fa-plus mr-2"></i>Tambah Produk</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_produk">Nama Produk</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-box"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="nama_produk" placeholder="Nama Produk">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="kategori">Kategori</label>
                                <select class="form-control" id="kategori">
                                    <option value="" selected disabled>Pilih Kategori</option>
                                    <option value="Makanan">Makanan</option>
                                    <option value="Minuman">Minuman</option>
                                    <option value="Kerajinan">Kerajinan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="umkm">UMKM</label>
                                <select class="form-control" id="umkm">
                                    <option value="" selected disabled>Pilih UMKM</option>
                                    <option value="UMKM Sari Rasa">UMKM Sari Rasa</option>
                                    <option value="UMKM Pisang Jaya">UMKM Pisang Jaya</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="harga">Harga</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input type="number" class="form-control" id="harga" placeholder="Harga Produk">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="foto">Foto Produk</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-image"></i></span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="foto" onchange="previewFotoProduk(event)">
                                        <label class="custom-file-label" for="foto">Pilih foto...</label>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <img id="preview-img-produk" src="{{ asset('img/default-produk.png') }}" alt="Preview" class="img-thumbnail border-primary" width="80" style="object-fit:cover;">
                                </div>
                                <small class="form-text text-muted">Format: JPG, PNG. Maks 2MB.</small>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi" rows="3" placeholder="Deskripsi Produk"></textarea>
                            </div>
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

<!-- Modal Edit Produk (dummy, isi sama dengan tambah) -->
<div class="modal fade" id="modalEditProduk" tabindex="-1" role="dialog" aria-labelledby="modalEditProdukLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="modalEditProdukLabel"><i class="fas fa-edit mr-2"></i>Edit Produk</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_nama_produk">Nama Produk</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-box"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="edit_nama_produk" value="Kue Lapis Legit">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="edit_kategori">Kategori</label>
                                <select class="form-control" id="edit_kategori">
                                    <option value="Makanan">Makanan</option>
                                    <option value="Minuman">Minuman</option>
                                    <option value="Kerajinan">Kerajinan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="edit_umkm">UMKM</label>
                                <select class="form-control" id="edit_umkm">
                                    <option value="UMKM Sari Rasa">UMKM Sari Rasa</option>
                                    <option value="UMKM Pisang Jaya">UMKM Pisang Jaya</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_harga">Harga</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input type="number" class="form-control" id="edit_harga" value="50000">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="edit_foto">Foto Produk</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-image"></i></span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="edit_foto" onchange="previewEditFotoProduk(event)">
                                        <label class="custom-file-label" for="edit_foto">Pilih foto...</label>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <img id="preview-img-edit-produk" src="{{ asset('img/produk1.jpg') }}" alt="Preview" class="img-thumbnail border-primary" width="80" style="object-fit:cover;">
                                </div>
                                <small class="form-text text-muted">Format: JPG, PNG. Maks 2MB.</small>
                            </div>
                            <div class="form-group">
                                <label for="edit_deskripsi">Deskripsi</label>
                                <textarea class="form-control" id="edit_deskripsi" rows="3">Kue lapis legit enak dan lembut.</textarea>
                            </div>
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
    function previewFotoProduk(event) {
        const [file] = event.target.files;
        if (file) {
            document.getElementById('preview-img-produk').src = URL.createObjectURL(file);
            const label = document.querySelector('label[for="foto"].custom-file-label');
            if (label) label.textContent = file.name;
        }
    }
    function previewEditFotoProduk(event) {
        const [file] = event.target.files;
        if (file) {
            document.getElementById('preview-img-edit-produk').src = URL.createObjectURL(file);
            const label = document.querySelector('label[for="edit_foto"].custom-file-label');
            if (label) label.textContent = file.name;
        }
    }
    $(document).ready(function() {
        $('.table').DataTable();
        $('.custom-file-input').on('change', function() {
            var fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    });
</script>
@endpush
