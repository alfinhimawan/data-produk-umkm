@extends('owner.layouts.app')

@section('title', 'Produk Saya')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Produk Saya</h1>
        <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalTambahProduk">
            <i class="fas fa-plus"></i> Tambah Produk
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

    <!-- Tabel Produk -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Produk</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="tabel-produk-owner" width="100%" cellspacing="0">
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
                                <td data-id="{{ $product->id_kategori }}">{{ $product->category->nama_kategori ?? '-' }}
                                </td>
                                <td data-id="{{ $product->id_umkm }}">{{ $product->umkmProfile->nama_umkm ?? '-' }}</td>
                                <td>Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                                <td>
                                    @if ($product->foto)
                                        <img src="{{ asset($product->foto) }}" alt="Foto" class="img-thumbnail"
                                            width="60">
                                    @else
                                        <img src="{{ asset('img/default-produk.png') }}" alt="Foto"
                                            class="img-thumbnail" width="60">
                                    @endif
                                </td>
                                <td>
                                    <a href="#" class="btn btn-info btn-sm btn-edit-produk" title="Edit"
                                        data-toggle="modal" data-target="#modalEditProduk"
                                        data-id="{{ $product->id_product }}"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('owner.products.destroy', $product->id_product) }}"
                                        method="POST" style="display:inline-block;" class="form-hapus-produk">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm btn-hapus-produk"
                                            title="Hapus"><i class="fas fa-trash"></i></button>
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
    @include('owner.products._modal_tambah_produk')

    <!-- Modal Edit Produk -->
    @include('owner.products._modal_edit_produk')
@endsection

@push('scripts')
    <script src="{{ asset('js/owner/owner-products.js') }}"></script>
@endpush
