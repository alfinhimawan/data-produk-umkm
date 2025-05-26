@extends('admin.layouts.app')

@section('title', 'Data User UMKM')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data User UMKM</h1>
        <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalTambahUser">
            <i class="fas fa-plus"></i> Tambah User
        </a>
    </div>

    <!-- Tabel User -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar User</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Foto</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Contoh data statis -->
                        <tr>
                            <td>1</td>
                            <td>Ahmad Fauzi</td>
                            <td>ahmad@email.com</td>
                            <td>umkm_owner</td>
                            <td><img src="{{ asset('img/user1.jpg') }}" alt="Foto" class="img-thumbnail" width="50"></td>
                            <td><span class="badge badge-success">Aktif</span></td>
                            <td>
                                <a href="#" class="btn btn-info btn-sm" title="Edit"><i class="fas fa-edit"></i></a>
                                <a href="#" class="btn btn-warning btn-sm" title="Reset Password"><i class="fas fa-key"></i></a>
                                <a href="#" class="btn btn-danger btn-sm" title="Nonaktifkan"><i class="fas fa-user-slash"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Siti Aminah</td>
                            <td>siti@email.com</td>
                            <td>admin</td>
                            <td><img src="{{ asset('img/user2.jpg') }}" alt="Foto" class="img-thumbnail" width="50"></td>
                            <td><span class="badge badge-danger">Nonaktif</span></td>
                            <td>
                                <a href="#" class="btn btn-info btn-sm" title="Edit"><i class="fas fa-edit"></i></a>
                                <a href="#" class="btn btn-warning btn-sm" title="Reset Password"><i class="fas fa-key"></i></a>
                                <a href="#" class="btn btn-success btn-sm" title="Aktifkan"><i class="fas fa-user-check"></i></a>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Tambah User -->
    <div class="modal fade" id="modalTambahUser" tabindex="-1" role="dialog" aria-labelledby="modalTambahUserLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalTambahUserLabel"><i class="fas fa-user-plus mr-2"></i>Tambah User UMKM</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="nama" placeholder="Nama User">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        </div>
                                        <input type="email" class="form-control" id="email" placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                                        </div>
                                        <input type="password" class="form-control" id="password" placeholder="Password">
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
                                    <select class="form-control" id="role">
                                        <option value="" selected disabled>Pilih Role</option>
                                        <option value="umkm_owner">UMKM Owner</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status">
                                        <option value="" selected disabled>Pilih Status</option>
                                        <option value="aktif">Aktif</option>
                                        <option value="nonaktif">Nonaktif</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="foto">Foto</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-image"></i></span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="foto" onchange="previewFoto(event)">
                                            <label class="custom-file-label" for="foto">Pilih foto...</label>
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <img id="preview-img" src="{{ asset('img/default-user.png') }}" alt="Preview" class="img-thumbnail border-primary" width="80" style="object-fit:cover;">
                                    </div>
                                    <small class="form-text text-muted">Format: JPG, PNG. Maks 2MB.</small>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Simpan</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function previewFoto(event) {
        const [file] = event.target.files;
        if (file) {
            document.getElementById('preview-img').src = URL.createObjectURL(file);
            const label = document.querySelector('label[for="foto"].custom-file-label');
            if (label) label.textContent = file.name;
        }
    }
    function togglePassword() {
        const input = document.getElementById('password');
        const icon = document.getElementById('togglePasswordIcon');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
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
