@extends('admin.layouts.app')

@section('title', 'Produk UMKM')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Produk UMKM</h1>
        <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalTambahProduk">
            <i class="fas fa-plus"></i> Tambah Produk
        </a>
    </div>

    <!-- Filter Produk -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Filter Produk</h6>
        </div>
        <div class="card-body">
            <form class="form-row mb-3" method="GET" action="{{ route('products.index') }}">
                <div class="form-group col-md-3">
                    <label for="filter_nama">Nama Produk</label>
                    <input type="text" class="form-control" id="filter_nama" name="nama" value="{{ request('nama') }}"
                        placeholder="Cari nama produk...">
                </div>
                <div class="form-group col-md-3">
                    <label for="filter_kategori">Kategori</label>
                    <select class="form-control" id="filter_kategori" name="kategori">
                        <option value="" selected>Semua Kategori</option>
                        @foreach ($categories as $kategori)
                            <option value="{{ $kategori->id_kategori }}"
                                {{ request('kategori') == $kategori->id_kategori ? 'selected' : '' }}>
                                {{ $kategori->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="filter_umkm">UMKM</label>
                    <select class="form-control" id="filter_umkm" name="umkm">
                        <option value="" selected>Semua UMKM</option>
                        @foreach ($umkmProfiles as $umkm)
                            <option value="{{ $umkm->id_umkm }}" {{ request('umkm') == $umkm->id_umkm ? 'selected' : '' }}>
                                {{ $umkm->nama_umkm }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="filter_status">Status UMKM</label>
                    <select class="form-control" id="filter_status" name="status">
                        <option value="" selected>Semua Status</option>
                        <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="nonaktif" {{ request('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>
                <div class="form-group col-md-12 mt-2">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-search mr-1"></i> Cari</button>
                    <a href="{{ route('products.index') }}" class="btn btn-secondary ml-2">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Notifikasi -->
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
                            <th>Stock</th>
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
                                <td>{{ $product->stock }}</td>
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
                                    <a href="#" class="btn btn-info btn-sm btn-edit-produk"
                                        data-id="{{ $product->id_product }}" data-toggle="modal"
                                        data-target="#modalEditProduk"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('products.destroy', $product->id_product) }}" method="POST"
                                        style="display:inline-block;">
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
    @include('admin.products._modal_tambah_produk', [
        'categories' => $categories ?? [],
        'umkmProfiles' => $umkmProfiles ?? [],
    ])

    <!-- Modal Edit Produk -->
    @include('admin.products._modal_edit_produk', [
        'categories' => $categories ?? [],
        'umkmProfiles' => $umkmProfiles ?? [],
    ])
@endsection

@push('scripts')
    <script src="{{ asset('js/admin/admin-products.js') }}"></script>
@endpush
