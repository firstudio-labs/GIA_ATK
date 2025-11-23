<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ManageLayanan;
use App\Models\ManageProduk;
use App\Models\ManageSection;
use App\Models\Pesanan;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardSuperAdminController extends Controller
{
    public function index(){
        // Statistik dasar
        $totalLayanan = ManageLayanan::count();
        $totalProduk = ManageProduk::count();
        $totalProdukAktif = ManageProduk::where('status', 'aktif')->count();
        $totalProdukNonaktif = ManageProduk::where('status', 'nonaktif')->count();
        $totalSection = ManageSection::count();
        $totalPesanan = Pesanan::count();
        $totalUsers = User::where('role', 'user')->count();
        
        // Statistik pesanan
        $totalPendapatan = Pesanan::sum('total');
        $pesananBulanIni = Pesanan::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();
        $pendapatanBulanIni = Pesanan::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('total');
        
        // Pesanan 7 hari terakhir
        $pesanan7HariTerakhir = Pesanan::where('created_at', '>=', Carbon::now()->subDays(7))
            ->count();
        
        // Chart data - Pesanan per bulan (6 bulan terakhir)
        $pesananPerBulan = Pesanan::select(
                DB::raw('MONTH(created_at) as bulan'),
                DB::raw('YEAR(created_at) as tahun'),
                DB::raw('COUNT(*) as total')
            )
            ->where('created_at', '>=', Carbon::now()->subMonths(6))
            ->groupBy('bulan', 'tahun')
            ->orderBy('tahun', 'asc')
            ->orderBy('bulan', 'asc')
            ->get();
        
        // Chart data - Pendapatan per bulan (6 bulan terakhir)
        $pendapatanPerBulan = Pesanan::select(
                DB::raw('MONTH(created_at) as bulan'),
                DB::raw('YEAR(created_at) as tahun'),
                DB::raw('SUM(total) as total')
            )
            ->where('created_at', '>=', Carbon::now()->subMonths(6))
            ->groupBy('bulan', 'tahun')
            ->orderBy('tahun', 'asc')
            ->orderBy('bulan', 'asc')
            ->get();
        
        // Pesanan terbaru
        $pesananTerbaru = Pesanan::with('user')
            ->latest()
            ->take(10)
            ->get();
        
        // Format data untuk chart
        $chartLabels = [];
        $chartPesanan = [];
        $chartPendapatan = [];
        
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $bulan = $date->format('M Y');
            $chartLabels[] = $bulan;
            
            $pesanan = $pesananPerBulan->firstWhere('bulan', $date->month);
            $chartPesanan[] = $pesanan ? $pesanan->total : 0;
            
            $pendapatan = $pendapatanPerBulan->firstWhere('bulan', $date->month);
            $chartPendapatan[] = $pendapatan ? (int)$pendapatan->total : 0;
        }
        
        return view('page_admin.dashboard.index', compact(
            'totalLayanan',
            'totalProduk',
            'totalProdukAktif',
            'totalProdukNonaktif',
            'totalSection',
            'totalPesanan',
            'totalUsers',
            'totalPendapatan',
            'pesananBulanIni',
            'pendapatanBulanIni',
            'pesanan7HariTerakhir',
            'pesananTerbaru',
            'chartLabels',
            'chartPesanan',
            'chartPendapatan'
        ));
    }
}
