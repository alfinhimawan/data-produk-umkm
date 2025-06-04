<!-- Modal Edit Profil UMKM -->
<div class="modal fade" id="modalEditUMKM" tabindex="-1" role="dialog" aria-labelledby="modalEditUMKMLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalEditUMKMLabel"><i class="fas fa-edit mr-2"></i>Edit Profil UMKM</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form
                action="{{ isset($umkm) ? route('owner.umkm-profile.update', $umkm->id_umkm) : route('owner.umkm-profile.store') }}"
                method="POST" enctype="multipart/form-data" id="formEditUMKM">
                @csrf
                @if (isset($umkm))
                    @method('PUT')
                @endif
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_nama_umkm">Nama UMKM</label>
                                <input type="text" class="form-control" id="edit_nama_umkm" name="nama_umkm"
                                    value="{{ $umkm->nama_umkm ?? '' }}" required placeholder="Masukkan nama UMKM">
                            </div>
                            <div class="form-group">
                                <label for="edit_alamat">Alamat</label>
                                <textarea class="form-control" id="edit_alamat" name="alamat" rows="3" required
                                    placeholder="Masukkan alamat lengkap UMKM">{{ $umkm->alamat ?? '' }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="edit_kontak">Kontak</label>
                                <input type="text" class="form-control" id="edit_kontak" name="kontak"
                                    value="{{ $umkm->kontak ?? '' }}" required placeholder="Nomor WA / Telepon aktif">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_logo">Logo</label>
                                <input type="file" class="form-control-file" id="edit_logo" name="logo"
                                    accept="image/*" onchange="previewLogoUMKM(event)">
                                <div class="mt-2">
                                    <img id="preview-img-umkm" src="{{ asset($umkm->logo ?? 'img/default-umkm.png') }}?t={{ now()->timestamp }}"
    data-default="{{ asset($umkm->logo ?? 'img/default-umkm.png') }}?t={{ now()->timestamp }}"
    alt="Preview" class="img-thumbnail border-primary" width="90" style="object-fit:cover;">
                                </div>
                                <small class="form-text text-muted">Format: JPG, JPEG, PNG. Maks 2MB.</small>
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
