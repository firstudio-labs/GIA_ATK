<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\ManageLayanan;
use App\Models\OwnerWhatsapp;

class LayananController extends Controller
{
    public function index()
    {
        $manageLayanans = ManageLayanan::orderBy('created_at', 'desc')->get();
        $ownerWhatsapp = OwnerWhatsapp::first();
        return view('page_web.layanan.index', compact('manageLayanans', 'ownerWhatsapp'));
    }

    public function detail($judul_layanan)
    {
        $manageLayanan = ManageLayanan::where('judul_layanan', $judul_layanan)->first();
        $manageLayanans = ManageLayanan::orderBy('created_at', 'desc')->get();
        $ownerWhatsapp = OwnerWhatsapp::first();
        if (!$manageLayanan) {
            return redirect()->route('layanan.index')->with('error', 'Layanan tidak ditemukan');
        }
        return view('page_web.layanan.detail', compact('manageLayanan', 'manageLayanans', 'ownerWhatsapp'));
    }
}