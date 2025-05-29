@extends('owner.layouts.app')

@section('title', 'Produk Saya')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Produk Saya</h1>
        <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalTambahProduk">
            <i class="fas fa-plus"></i> Tambah Produk
        </a>
    </div>

    <!-- Alert (dummy, untuk notifikasi sukses/gagal) -->
    <div id="alert-placeholder"></div>

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
                                    <a href="#" class="btn btn-info btn-sm btn-edit-produk" title="Edit"
                                        data-toggle="modal" data-target="#modalEditProduk" data-id="{{ $product->id_product }}"><i
                                        class="fas fa-edit"></i></a>
                                    <form action="{{ route('owner.products.destroy', $product->id_product) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm btn-hapus-produk" title="Hapus"><i
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

    <!-- Modal Tambah Produk -->
    @include('owner.products._modal_tambah_produk')

    <!-- Modal Edit Produk -->
    @include('owner.products._modal_edit_produk')
@endsection

@push('scripts')
    <script src="{{ asset('js/owner/owner-products.js') }}"></script>
@endpush
