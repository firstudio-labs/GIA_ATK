<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\ManageProduk;
use App\Models\ManageKategori;
use App\Models\OwnerWhatsapp;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = ManageProduk::where('status', 'aktif')
            ->with(['kategori', 'subKategori']);
        
        // Filter by kategori
        if ($request->has('kategori') && $request->kategori) {
            $query->where('kategori_id', $request->kategori);
        }
        
        // Filter by search
        if ($request->has('search') && $request->search) {
            $query->where('judul', 'like', '%' . $request->search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
        }
        
        // Filter by price range
        if ($request->has('min_price') && $request->min_price) {
            $query->where('harga', '>=', $request->min_price);
        }
        if ($request->has('max_price') && $request->max_price) {
            $query->where('harga', '<=', $request->max_price);
        }
        
        // Filter by ukuran
        if ($request->has('ukuran') && $request->ukuran) {
            $query->where('ukuran', $request->ukuran);
        }
        
        // Filter by warna
        if ($request->has('warna') && $request->warna) {
            $query->where('warna', $request->warna);
        }
        
        // Sorting
        $sort = $request->get('sort', 'latest');
        switch($sort) {
            case 'price_low':
                $query->orderBy('harga', 'asc');
                break;
            case 'price_high':
                $query->orderBy('harga', 'desc');
                break;
            case 'latest':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }
        
        $produks = $query->paginate(12);
        
        $kategoris = ManageKategori::all();
        $ownerWhatsapp = OwnerWhatsapp::first();
        
        // Get unique values for filters
        $ukuranList = ManageProduk::where('status', 'aktif')
            ->whereNotNull('ukuran')
            ->distinct()
            ->pluck('ukuran')
            ->filter()
            ->values();
        
        $warnaList = ManageProduk::where('status', 'aktif')
            ->whereNotNull('warna')
            ->distinct()
            ->pluck('warna')
            ->filter()
            ->values();
        
        // Get min and max price
        $minPrice = ManageProduk::where('status', 'aktif')->min('harga') ?? 0;
        $maxPrice = ManageProduk::where('status', 'aktif')->max('harga') ?? 1000000;
        
        return view('page_web.shop.index', compact('produks', 'kategoris', 'ownerWhatsapp', 'ukuranList', 'warnaList', 'minPrice', 'maxPrice'));
    }

    public function detail($slug)
    {
        $produk = ManageProduk::where('slug', $slug)
            ->with(['kategori', 'subKategori'])
            ->firstOrFail();
        
        // Ambil produk terkait dari kategori yang sama
        $relatedProduks = ManageProduk::where('kategori_id', $produk->kategori_id)
            ->where('id', '!=', $produk->id)
            ->where('status', 'aktif')
            ->limit(4)
            ->get();
        
        $ownerWhatsapp = OwnerWhatsapp::first();
        
        return view('page_web.shop.detail', compact('produk', 'relatedProduks', 'ownerWhatsapp'));
    }
}

