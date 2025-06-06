<div class="modal fade" id="modalEditProduk" tabindex="-1" role="dialog" aria-labelledby="modalEditProdukLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="modalEditProdukLabel"><i class="fas fa-edit mr-2"></i>Edit Produk</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formEditProduk" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_nama_produk">Nama Produk</label>
                                <input type="text" class="form-control" id="edit_nama_produk" name="nama_produk" placeholder="Nama Produk" required>
                            </div>
                            <div class="form-group">
                                <label for="edit_id_kategori">Kategori</label>
                                <select class="form-control" id="edit_id_kategori" name="id_kategori" required>
                                    <option value="" selected disabled>Pilih Kategori</option>
                                    @foreach($categories as $kategori)
                                        <option value="{{ $kategori->id_kategori }}">{{ $kategori->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="edit_harga">Harga</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input type="number" class="form-control" id="edit_harga" name="harga" placeholder="Harga Produk" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="edit_stock">Stock</label>
                                <input type="number" class="form-control" id="edit_stock" name="stock" min="0" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_foto">Foto Produk</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-image"></i></span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="edit_foto" name="foto" accept="image/*" onchange="previewEditFotoProduk(event)">
                                        <label class="custom-file-label" for="edit_foto">Pilih foto...</label>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <img id="preview-img-edit-produk" src="{{ asset('img/default-produk.png') }}" alt="Preview" class="img-thumbnail border-primary" width="80" style="object-fit:cover;">
                                </div>
                                <small class="form-text text-muted">Format: JPG, JPEG, PNG. Maks 2MB.</small>
                            </div>
                            <div class="form-group">
                                <label for="edit_deskripsi">Deskripsi</label>
                                <textarea class="form-control" id="edit_deskripsi" name="deskripsi" rows="3" placeholder="Deskripsi Produk" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-info">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
