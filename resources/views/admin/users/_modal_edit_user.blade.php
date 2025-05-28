<!-- Modal Edit User (DIPISAH) -->
<div class="modal fade" id="modalEditUser" tabindex="-1" role="dialog" aria-labelledby="modalEditUserLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="modalEditUserLabel"><i class="fas fa-user-edit mr-2"></i>Edit User UMKM</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formEditUser" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_user_id" name="user_id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_nama">Nama</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="edit_nama" name="name" placeholder="Nama User" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="edit_email">Email</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    </div>
                                    <input type="email" class="form-control" id="edit_email" name="email" placeholder="Email" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="edit_password">Password <small class="text-muted">(Kosongkan jika tidak diubah)</small></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    </div>
                                    <input type="password" class="form-control" id="edit_password" name="password" placeholder="Password">
                                    <div class="input-group-append">
                                        <span class="input-group-text" style="cursor:pointer;" onclick="toggleEditPassword()">
                                            <i class="fas fa-eye" id="toggleEditPasswordIcon"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_role">Role</label>
                                <select class="form-control" id="edit_role" name="role" onchange="toggleEditStatusDropdown()" required>
                                    <option value="admin">Admin</option>
                                    <option value="umkm_owner">UMKM Owner</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="edit_status">Status</label>
                                <select class="form-control" id="edit_status" name="status">
                                    <option value="aktif">Aktif</option>
                                    <option value="nonaktif">Nonaktif</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="edit_foto">Foto</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-image"></i></span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="edit_foto" name="foto" onchange="previewEditFoto(event)">
                                        <label class="custom-file-label" for="edit_foto">Pilih foto...</label>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <img id="edit-preview-img" src="{{ asset('img/default-user.png') }}" alt="Preview" class="img-thumbnail border-info" width="80" style="object-fit:cover;">
                                </div>
                                <small class="form-text text-muted">Format: JPG, PNG. Maks 2MB.</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-info"><i class="fas fa-save mr-1"></i> Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END Modal Edit User -->
