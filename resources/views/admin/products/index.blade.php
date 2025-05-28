@extends('admin.layouts.app')

@section('title', 'Produk UMKM')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Produk UMKM</h1>
    <div>
        <a href="{{ route('products.search') }}" class="btn btn-info btn-sm mr-2">
            <i class="fas fa-filter"></i> Filter Produk
        </a>
        <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalTambahProduk">
            <i class="fas fa-plus"></i> Tambah Produk
        </a>
    </div>
</div>

<!-- Notifikasi -->
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-pill shadow-sm px-4 py-3 d-flex align-items-center" role="alert" style="font-size:1.05rem;">
        <i class="fas fa-check-circle fa-lg mr-3"></i> <span>{{ session('success') }}</span>
        <button type="button" class="close ml-auto" data-dismiss="alert" aria-label="Close" style="outline:none;">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show rounded-pill shadow-sm px-4 py-3 d-flex align-items-center" role="alert" style="font-size:1.05rem;">
        <i class="fas fa-times-circle fa-lg mr-3"></i> <span>{{ session('error') }}</span>
        <button type="button" class="close ml-auto" data-dismiss="alert" aria-label="Close" style="outline:none;">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show rounded shadow-sm px-4 py-3" role="alert" style="font-size:1.05rem;">
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
                    @foreach ($products as $index => $product)
                    <tr data-deskripsi="{{ $product->deskripsi }}">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $product->nama_produk }}</td>
                        <td data-id="{{ $product->id_kategori }}">{{ $product->category->nama_kategori ?? '-' }}</td>
                        <td data-id="{{ $product->id_umkm }}">{{ $product->umkmProfile->nama_umkm ?? '-' }}</td>
                        <td>Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                        <td>
                            @if ($product->foto)
                                <img src="{{ asset($product->foto) }}" alt="Foto" class="img-thumbnail" width="60">
                            @else
                                <img src="{{ asset('img/default-produk.png') }}" alt="Foto" class="img-thumbnail" width="60">
                            @endif
                        </td>
                        <td>
                            <a href="#" class="btn btn-info btn-sm btn-edit-produk" data-id="{{ $product->id_product }}" data-toggle="modal" data-target="#modalEditProduk"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('products.destroy', $product->id_product) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm btn-hapus-produk" title="Hapus"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah Produk -->
@include('admin.products._modal_tambah_produk', ['categories' => $categories ?? [], 'umkmProfiles' => $umkmProfiles ?? []])

<!-- Modal Edit Produk -->
@include('admin.products._modal_edit_produk', ['categories' => $categories ?? [], 'umkmProfiles' => $umkmProfiles ?? []])
@endsection

@push('scripts')
<script src="{{ asset('js/admin-products.js') }}"></script>
@endpush
