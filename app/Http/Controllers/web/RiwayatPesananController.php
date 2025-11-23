<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use App\Models\Profil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatPesananController extends Controller
{
    public function index()
    {
        $pesanans = Pesanan::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
        return view('page_web.riwayat_pesanan.index', compact('pesanans'));
    }

    public function detail($id)
    {
        $pesanan = Pesanan::where('user_id', Auth::id())
            ->where('id', $id)
            ->firstOrFail();
        
        return view('page_web.riwayat_pesanan.detail', compact('pesanan'));
    }

    public function invoice($id)
    {
        $pesanan = Pesanan::where('user_id', Auth::id())
            ->where('id', $id)
            ->with('user')
            ->firstOrFail();
        
        $profil = Profil::first();
        
        return view('page_web.riwayat_pesanan.invoice', compact('pesanan', 'profil'));
    }
}