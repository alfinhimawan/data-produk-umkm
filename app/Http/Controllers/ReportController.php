<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\UMKMProfile;
use App\Exports\ProductReportExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $umkmProfiles = UMKMProfile::all();
        $query = Product::with(['category', 'umkmProfile']);

        if ($request->filled('kategori')) {
            $query->where('id_kategori', $request->kategori);
        }
        if ($request->filled('umkm')) {
            $query->where('id_umkm', $request->umkm);
        }

        $products = $query->get();
        return view('admin.reports.index', compact('products', 'categories', 'umkmProfiles', 'request'));
    }

    public function export(Request $request)
    {
        $query = Product::with(['category', 'umkmProfile']);
        if ($request->filled('kategori')) {
            $query->where('id_kategori', $request->kategori);
        }
        if ($request->filled('umkm')) {
            $query->where('id_umkm', $request->umkm);
        }
        $products = $query->get();
        return Excel::download(new ProductReportExport($products), 'laporan_produk_umkm.xlsx');
    }
}
