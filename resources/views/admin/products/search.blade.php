@extends('admin.layouts.app')

@section('title', 'Search & Filter Produk')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Search & Filter Produk</h1>
</div>

<!-- Filter Produk -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Filter Produk</h6>
    </div>
    <div class="card-body">
        <form class="form-row mb-3" method="GET" action="{{ route('products.search') }}">
            <div class="form-group col-md-3">
                <label for="filter_nama">Nama Produk</label>
                <input type="text" class="form-control" id="filter_nama" name="nama" value="{{ request('nama') }}" placeholder="Cari nama produk...">
            </div>
            <div class="form-group col-md-3">
                <label for="filter_kategori">Kategori</label>
                <select class="form-control" id="filter_kategori" name="kategori">
                    <option value="" selected>Semua Kategori</option>
                    @foreach($categories as $kategori)
                        <option value="{{ $kategori->id_kategori }}" {{ request('kategori') == $kategori->id_kategori ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="filter_umkm">UMKM</label>
                <select class="form-control" id="filter_umkm" name="umkm">
                    <option value="" selected>Semua UMKM</option>
                    @foreach($umkmProfiles as $umkm)
                        <option value="{{ $umkm->id_umkm }}" {{ request('umkm') == $umkm->id_umkm ? 'selected' : '' }}>{{ $umkm->nama_umkm }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="filter_status">Status Produk</label>
                <select class="form-control" id="filter_status" name="status">
                    <option value="" selected>Semua Status</option>
                    <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="nonaktif" {{ request('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>
            <div class="form-group col-md-12 mt-2">
                <button type="submit" class="btn btn-primary"><i class="fas fa-search mr-1"></i> Cari</button>
                <a href="{{ route('products.search') }}" class="btn btn-secondary ml-2">Reset</a>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>UMKM</th>
                        <th>Harga</th>
                        <th>Status UMKM</th>
                        <th>Foto</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $index => $product)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $product->nama_produk }}</td>
                        <td>{{ $product->category->nama_kategori ?? '-' }}</td>
                        <td>{{ $product->umkmProfile->nama_umkm ?? '-' }}</td>
                        <td>Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                        <td>
                            @if ($product->umkmProfile && $product->umkmProfile->status === 'aktif')
                                <span class="badge badge-success">Aktif</span>
                            @else
                                <span class="badge badge-danger">Nonaktif</span>
                            @endif
                        </td>
                        <td>
                            @if ($product->foto)
                                <img src="{{ asset($product->foto) }}" alt="Foto" class="img-thumbnail" width="60">
                            @else
                                <img src="{{ asset('img/default-produk.png') }}" alt="Foto" class="img-thumbnail" width="60">
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data produk</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('.table').DataTable();
    });
</script>
@endpush
