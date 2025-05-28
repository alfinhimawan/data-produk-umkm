<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\UMKMProfile;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahProduk = Product::count();
        $jumlahUMKM = UMKMProfile::where('status', 'aktif')->count();
        $jumlahKategori = Category::count();
        $jumlahUser = User::count();

        $umkmPerBulan = UMKMProfile::selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy('bulan')
            ->pluck('total', 'bulan')->toArray();

        $pieStatusUMKM = [
            'Aktif' => UMKMProfile::where('status', 'aktif')->count(),
            'Nonaktif' => UMKMProfile::where('status', 'nonaktif')->count(),
        ];

        return view('admin.dashboard.index', compact(
            'jumlahProduk', 'jumlahUMKM', 'jumlahKategori', 'jumlahUser',
            'umkmPerBulan', 'pieStatusUMKM'
        ));
    }
}
