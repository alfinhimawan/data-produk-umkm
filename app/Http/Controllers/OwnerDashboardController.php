<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\UMKMProfile;
use App\Models\Category;

class OwnerDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if (!$user) {
            $umkm = UMKMProfile::first();
        } else {
            $umkm = UMKMProfile::where('id_users', $user->id_users)->first();
        }
        $jumlahProduk = $umkm ? Product::where('id_umkm', $umkm->id_umkm)->count() : 0;
        $namaUMKM = $umkm->nama_umkm ?? '-';
        $kontakUMKM = $umkm->kontak ?? '-';

        // Grafik penambahan produk per bulan (line chart)
        $produkPerBulan = $umkm ? Product::selectRaw('EXTRACT(MONTH FROM created_at) as bulan, COUNT(*) as total')
            ->where('id_umkm', $umkm->id_umkm)
            ->whereRaw('EXTRACT(YEAR FROM created_at) = ?', [date('Y')])
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('total', 'bulan')->toArray() : [];
        $bulanLabels = [];
        $produkData = [];
        foreach (range(1, 12) as $b) {
            $bulanLabels[] = __(date('F', mktime(0, 0, 0, $b, 1)));
            $produkData[] = $produkPerBulan[$b] ?? 0;
        }

        $kategoriBar = $umkm ? Category::withCount(['products' => function($q) use ($umkm) {
            $q->where('id_umkm', $umkm->id_umkm);
        }])->orderByDesc('products_count')->get() : collect();
        $kategoriBarLabels = $kategoriBar->pluck('nama_kategori')->toArray();
        $kategoriBarData = $kategoriBar->pluck('products_count')->toArray();

        $topN = 3;
        $topCategories = $kategoriBar->take($topN);

        return view('owner.dashboard.dashboard', compact(
            'jumlahProduk', 'namaUMKM', 'kontakUMKM',
            'bulanLabels', 'produkData', 'kategoriBarLabels', 'kategoriBarData',
            'topCategories'
        ));
    }
}
