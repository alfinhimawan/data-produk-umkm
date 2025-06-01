@extends('admin.layouts.app')

@section('title', 'Laporan Produk')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Laporan Produk</h1>
</div>

<!-- Filter Laporan -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Filter Laporan</h6>
    </div>
    <div class="card-body">
        <form class="form-inline mb-3" method="GET" action="{{ route('reports.index') }}">
            <div class="form-group mr-3">
                <label for="filter_kategori" class="mr-2">Kategori</label>
                <select class="form-control" id="filter_kategori" name="kategori">
                    <option value="" selected>Semua Kategori</option>
                    @foreach($categories as $kategori)
                        <option value="{{ $kategori->id_kategori }}" {{ request('kategori') == $kategori->id_kategori ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mr-3">
                <label for="filter_umkm" class="mr-2">UMKM</label>
                <select class="form-control" id="filter_umkm" name="umkm">
                    <option value="" selected>Semua UMKM</option>
                    @foreach($umkmProfiles as $umkm)
                        <option value="{{ $umkm->id_umkm }}" {{ request('umkm') == $umkm->id_umkm ? 'selected' : '' }}>{{ $umkm->nama_umkm }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-filter mr-1"></i> Filter</button>
            <button type="button" class="btn btn-success ml-2" id="btn-export-excel"><i class="fas fa-file-excel mr-1"></i> Export Excel</button>
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
                        <th>Foto</th>
                        <th>Status UMKM</th>
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
                            @if ($product->foto)
                                <img src="{{ asset($product->foto) }}" alt="Foto" class="img-thumbnail" width="60">
                            @else
                                <img src="{{ asset('img/default-produk.png') }}" alt="Foto" class="img-thumbnail" width="60">
                            @endif
                        </td>
                        <td>
                            @if ($product->umkmProfile && $product->umkmProfile->status === 'aktif')
                                <span class="badge badge-success">Aktif</span>
                            @else
                                <span class="badge badge-danger">Nonaktif</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
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

    document.getElementById('btn-export-excel')?.addEventListener('click', function() {
        const params = new URLSearchParams(window.location.search);
        window.location.href = "{{ route('reports.export') }}" + (params.toString() ? ('?' + params.toString()) : '');
    });
</script>
@endpush
