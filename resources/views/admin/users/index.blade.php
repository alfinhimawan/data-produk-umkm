@extends('admin.layouts.app')

@section('title', 'Data User UMKM')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data User UMKM</h1>
        <div>
            <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalTambahUser">
                <i class="fas fa-plus"></i> Tambah User
            </a>
            <a href="{{ route('users.trashed') }}" class="btn btn-warning btn-sm ml-2">
                <i class="fas fa-trash-restore"></i> User Owner Terhapus
            </a>
        </div>
    </div>

    <!-- Alert modern -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-pill shadow-sm px-4 py-3 d-flex align-items-center"
            role="alert" style="font-size:1.05rem;">
            <i class="fas fa-check-circle fa-lg mr-3"></i> <span>{{ session('success') }}</span>
            <button type="button" class="close ml-auto" data-dismiss="alert" aria-label="Close" style="outline:none;">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show rounded-pill shadow-sm px-4 py-3 d-flex align-items-center"
            role="alert" style="font-size:1.05rem;">
            <i class="fas fa-times-circle fa-lg mr-3"></i> <span>{{ session('error') }}</span>
            <button type="button" class="close ml-auto" data-dismiss="alert" aria-label="Close" style="outline:none;">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show rounded shadow-sm px-4 py-3" role="alert"
            style="font-size:1.05rem;">
            <div class="d-flex align-items-center mb-2"><i class="fas fa-exclamation-triangle fa-lg mr-2"></i>
                <strong>Validasi Gagal</strong>
            </div>
            <ul class="mb-0 pl-4">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="outline:none;">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <!-- END Alert modern -->

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
                        @foreach ($users as $index => $user)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>
                                <td>
                                    @if ($user->foto)
                                        <img src="{{ asset($user->foto) }}" alt="Foto" class="img-thumbnail"
                                            width="50">
                                    @else
                                        <img src="{{ asset('img/default-user.png') }}" alt="Foto" class="img-thumbnail"
                                            width="50">
                                    @endif
                                </td>
                                <td>
                                    @if ($user->status === 'aktif')
                                        <span class="badge badge-success">Aktif</span>
                                    @elseif ($user->status === 'pending')
                                        <span class="badge badge-warning">Pending</span>
                                    @else
                                        <span class="badge badge-danger">Nonaktif</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="#" class="btn btn-info btn-sm btn-edit-user" title="Edit"
                                        data-toggle="modal" data-target="#modalEditUser"
                                        data-user='@json($user)'><i class="fas fa-edit"></i></a>
                                    @if ($user->role === 'umkm_owner')
                                        @if ($user->status === 'aktif')
                                            <form action="{{ route('users.update', $user->id_users) }}" method="POST"
                                                style="display:inline-block;">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="nonaktif">
                                                <button type="submit" class="btn btn-danger btn-sm" title="Nonaktifkan"><i
                                                        class="fas fa-user-slash"></i></button>
                                            </form>
                                        @else
                                            <form action="{{ route('users.update', $user->id_users) }}" method="POST"
                                                style="display:inline-block;">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="aktif">
                                                <button type="submit" class="btn btn-success btn-sm" title="Aktifkan"><i
                                                        class="fas fa-user-check"></i></button>
                                            </form>
                                        @endif
                                        <form action="{{ route('users.destroy', $user->id_users) }}" method="POST"
                                            style="display:inline-block;" class="form-hapus-user">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm btn-hapus-user"
                                                title="Hapus"><i class="fas fa-trash"></i></button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Tambah User -->
    @include('admin.users._modal_tambah_user')

    <!-- Modal Edit User -->
    @include('admin.users._modal_edit_user')
@endsection

@push('scripts')
    <script src="{{ asset('js/admin/admin-users.js') }}"></script>
@endpush
