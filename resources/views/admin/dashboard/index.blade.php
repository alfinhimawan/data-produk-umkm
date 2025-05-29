@extends('admin.layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard Admin</h1>
    </div>

    <!-- Content Row: Statistik -->
    <div class="row">
        <!-- Card: Jumlah Produk -->
        <div class="col-xl-3 col-md-6 mb-4">
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
        <!-- Card: UMKM Aktif -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                UMKM Aktif</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlahUMKM }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-store fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Card: Kategori Produk -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Kategori Produk</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlahKategori }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-tags fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Card: User Aktif -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                User Aktif</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlahUser }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row: Grafik & Pie Chart -->
    <div class="row">
        <!-- Area Chart: UMKM Baru per Bulan -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">UMKM Baru per Bulan ({{ date('Y') }})</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="umkmAreaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pie Chart: Status UMKM -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Status UMKM</h6>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2 d-flex justify-content-center align-items-center"
                        style="min-height:260;">
                        <canvas id="umkmPieChart" style="max-width:260;"></canvas>
                    </div>
                    <div class="mt-3 d-flex flex-column">
                        <div class="text-center small mb-2">
                            <span class="mr-3 pie-filter" data-status="Aktif" style="cursor:pointer;">
                                <i class="fas fa-circle" style="color:#1cc88a"></i> Aktif
                            </span>
                            <span class="mr-3 pie-filter" data-status="Nonaktif" style="cursor:pointer;">
                                <i class="fas fa-circle" style="color:#e74a3b"></i> Nonaktif
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @php
        $bulanLabels = [];
        $umkmData = [];
        foreach (range(1, 12) as $b) {
            $bulanLabels[] = __(date('F', mktime(0, 0, 0, $b, 1)));
            $umkmData[] = $umkmPerBulan[$b] ?? 0;
        }
    @endphp
    <script id="umkmPerBulanData" type="application/json">@json(['labels' => $bulanLabels, 'data' => $umkmData])</script>
    <script id="umkmPieData" type="application/json">@json($pieStatusUMKM)</script>

@endsection

@push('scripts')
    <script src="{{ asset('js/admin/admin-dashboard.js') }}"></script>
@endpush
