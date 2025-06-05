<!-- Modal Tambah User (DIPISAH) -->
<div class="modal fade" id="modalTambahUser" tabindex="-1" role="dialog" aria-labelledby="modalTambahUserLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalTambahUserLabel"><i class="fas fa-user-plus mr-2"></i>Tambah User UMKM</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="nama" name="name" placeholder="Nama User" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    </div>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    </div>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text" style="cursor:pointer;" onclick="togglePassword()">
                                            <i class="fas fa-eye" id="togglePasswordIcon"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select class="form-control" id="role" name="role" required readonly disabled>
                                    <option value="admin" selected>Admin</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status" disabled>
                                    <option value="aktif" selected>Aktif</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="foto">Foto</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-image"></i></span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="foto" name="foto" onchange="previewFoto(event)">
                                        <label class="custom-file-label" for="foto">Pilih foto...</label>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <img id="preview-img" src="{{ asset('img/default-user.png') }}" alt="Preview" class="img-thumbnail border-primary" width="80" style="object-fit:cover;">
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
<!-- END Modal Tambah User -->
