@extends('admin.layouts.app')

@section('title', 'Kategori Produk')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kategori Produk</h1>
        <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalTambahKategori">
            <i class="fas fa-plus"></i> Tambah Kategori
        </a>
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
                        @foreach ($categories as $index => $category)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $category->nama_kategori }}</td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm btn-edit-kategori"
                                        data-id="{{ $category->id_kategori }}" data-nama="{{ $category->nama_kategori }}"
                                        data-toggle="modal" data-target="#modalEditKategori"><i
                                            class="fas fa-edit"></i></button>
                                    <form action="{{ route('categories.destroy', $category->id_kategori) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus"><i
                                                class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Kategori -->
    @include('admin.categories._modal_tambah_kategori')

    <!-- Modal Edit Kategori (dummy, isi sama dengan tambah) -->
    @include('admin.categories._modal_edit_kategori')
@endsection

@push('scripts')
    <script src="{{ asset('js/admin-categories.js') }}"></script>
@endpush
