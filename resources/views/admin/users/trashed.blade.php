@extends('admin.layouts.app')

@section('title', 'User Owner Terhapus')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">User Owner Terhapus (Soft Delete)</h1>
        <a href="{{ route('users.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-pill shadow-sm px-4 py-3 d-flex align-items-center"
            role="alert" style="font-size:1.05rem;">
            <i class="fas fa-check-circle fa-lg mr-3"></i> <span>{{ session('success') }}</span>
            <button type="button" class="close ml-auto" data-dismiss="alert" aria-label="Close" style="outline:none;">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar User Owner Terhapus</h6>
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
                            <th>Waktu Dihapus</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $index => $user)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>
                                <td>
                                    @if ($user->foto)
                                        <img src="{{ asset($user->foto) }}" alt="Foto" class="img-thumbnail" width="50">
                                    @else
                                        <img src="{{ asset('img/default-user.png') }}" alt="Foto" class="img-thumbnail" width="50">
                                    @endif
                                </td>
                                <td>{{ $user->deleted_at }}</td>
                                <td>
                                    <form action="{{ route('users.restore', $user->id_users) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm" title="Pulihkan"><i class="fas fa-trash-restore"></i> Pulihkan</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada user owner yang terhapus.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
