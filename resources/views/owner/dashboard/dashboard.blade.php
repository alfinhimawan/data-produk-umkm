@extends('owner.layouts.app')

@section('title', 'Dashboard Owner')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard Owner</h1>
    </div>

    <!-- Statistik Cards -->
    <div class="row">
        <!-- Card: Jumlah Produk -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Jumlah Produk</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlahProduk }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-box fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Card: Nama UMKM -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Nama UMKM</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $namaUMKM }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-store fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Card: Kontak UMKM -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Kontak</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $kontakUMKM }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-phone fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik Produk (dummy) -->
    <div class="row">
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Grafik Penambahan Produk per Bulan ({{ date('Y') }})</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="produkPerBulanChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <!-- Top Kategori Card inserted here, chart removed -->
        @includeWhen(isset($topCategories), 'owner.dashboard._top_kategori_card', ['topCategories' => $topCategories])
    </div>

    <script id="produkPerBulanData" type="application/json">@json(['labels' => $bulanLabels, 'data' => $produkData])</script>
@endsection

@push('scripts')
    <script src="{{ asset('js/owner/owner-dashboard-umkm.js') }}"></script>
@endpush
