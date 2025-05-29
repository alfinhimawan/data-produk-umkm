<!-- Modal Edit Profil UMKM -->
<div class="modal fade" id="modalEditUMKM" tabindex="-1" role="dialog" aria-labelledby="modalEditUMKMLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gradient-primary text-white">
                <h5 class="modal-title" id="modalEditUMKMLabel"><i class="fas fa-edit mr-2"></i>Edit Profil UMKM</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" method="POST" enctype="multipart/form-data" id="formEditUMKM">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_nama_umkm">Nama UMKM</label>
                                <input type="text" class="form-control" id="edit_nama_umkm" name="nama_umkm" value="{{ $umkm->nama_umkm ?? '' }}" required>
                            </div>
                            <div class="form-group">
                                <label for="edit_alamat">Alamat</label>
                                <textarea class="form-control" id="edit_alamat" name="alamat" rows="3" required>{{ $umkm->alamat ?? '' }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="edit_kontak">Kontak</label>
                                <input type="text" class="form-control" id="edit_kontak" name="kontak" value="{{ $umkm->kontak ?? '' }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_foto">Logo/</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-image"></i></span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="edit_foto" name="foto" accept="image/*">
                                        <label class="custom-file-label" for="edit_foto">Pilih foto...</label>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <img id="preview-img-umkm" src="{{ asset($umkm->foto ?? 'img/default-umkm.png') }}" alt="Preview" class="img-thumbnail border-primary" width="90" style="object-fit:cover;">
                                </div>
                                <small class="form-text text-muted">Format: JPG, PNG. Maks 2MB.</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
