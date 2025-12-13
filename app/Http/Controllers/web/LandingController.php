<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Profil;
use App\Models\Beranda;
use App\Models\ManageSection;
use App\Models\ManageProduk;
use App\Models\ManageKategori;
use App\Models\OwnerWhatsapp;
use Illuminate\Support\Facades\DB;

class LandingController extends Controller
{
    public function index()
    {
        $profil = Profil::first();
        $beranda = Beranda::first();
        $ownerWhatsapp = OwnerWhatsapp::first();
        
        // Helper function untuk mengambil produk dari section
        $getProdukFromSection = function($section) {
            if (!$section) {
                return collect();
            }
            
            $rawProductIds = DB::table('manage_sections')
                ->where('id', $section->id)
                ->value('product_ids');
            
            if ($rawProductIds) {
                $productIds = json_decode($rawProductIds, true);
                
                if (is_array($productIds) && count($productIds) > 0) {
                    $productIds = array_filter($productIds, function($id) {
                        return $id !== null && $id !== '' && $id !== 0;
                    });
                    
                    $productIds = array_map(function($id) {
                        return (int) $id;
                    }, array_values($productIds));
                    
                    if (count($productIds) > 0) {
                        return ManageProduk::whereIn('id', $productIds)
                            ->where('status', 'aktif')
                            ->get()
                            ->sortBy(function($produk) use ($productIds) {
                                $index = array_search($produk->id, $productIds);
                                return $index !== false ? $index : 999;
                            })
                            ->values();
                    }
                }
            }
            
            return collect();
        };
        
        // Ambil semua section yang dibutuhkan
        $sectionNames = ['Top Produk', 'Recent', 'Top', 'Top Rating', 'Best Seller', 'Best Product'];
        $sections = ManageSection::whereIn('name', $sectionNames)->get()->keyBy('name');
        
        // Ambil produk untuk setiap section
        $topProduk = $getProdukFromSection($sections->get('Top Produk'));
        $recentProduk = $getProdukFromSection($sections->get('Recent'));
        $topProdukSection = $getProdukFromSection($sections->get('Top'));
        $topRatingProduk = $getProdukFromSection($sections->get('Top Rating'));
        $bestSellerProduk = $getProdukFromSection($sections->get('Best Seller'));
        $bestProduct = $getProdukFromSection($sections->get('Best Product'));
        
        // Untuk Recent, selalu ambil produk terbaru (jika section ada, gabungkan dengan produk terbaru)
        $produkTerbaru = ManageProduk::where('status', 'aktif')
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get();
        
        if ($recentProduk->isNotEmpty()) {
            // Gabungkan produk dari section dengan produk terbaru, pastikan tidak duplikat
            $existingIds = $recentProduk->pluck('id')->toArray();
            $produkTerbaruTambahan = $produkTerbaru->whereNotIn('id', $existingIds)->take(8 - $recentProduk->count());
            $recentProduk = $recentProduk->merge($produkTerbaruTambahan)->take(8);
        } else {
            // Jika section tidak ada, gunakan produk terbaru
            $recentProduk = $produkTerbaru;
        }
        
        // Ambil produk dikelompokkan per kategori untuk trending
        $produkPerKategori = ManageKategori::with(['produks' => function($query) {
            $query->where('status', 'aktif')
                  ->orderBy('created_at', 'desc')
                  ->take(8);
        }])
        ->whereHas('produks', function($query) {
            $query->where('status', 'aktif');
        })
        ->get()
        ->map(function($kategori) {
            return [
                'kategori' => $kategori,
                'produks' => $kategori->produks
            ];
        })
        ->filter(function($item) {
            return $item['produks']->count() > 0;
        });
        
        // Ambil semua kategori untuk sidebar
        $kategoris = ManageKategori::with(['produks' => function($query) {
            $query->where('status', 'aktif');
        }])
        ->whereHas('produks', function($query) {
            $query->where('status', 'aktif');
        })
        ->get();
        
        return view('page_web.landing.index', compact(
            'profil', 
            'beranda', 
            'ownerWhatsapp', 
            'topProduk',
            'recentProduk',
            'topProdukSection',
            'topRatingProduk',
            'bestSellerProduk',
            'bestProduct',
            'produkPerKategori',
            'kategoris',
            'sections'
        ));
    }
}