<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class DaftarRiwayatPesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Pesanan::with('user')->latest();
        
        // Pencarian berdasarkan order_id
        if ($request->has('search') && $request->search != '') {
            $query->where('order_id', 'like', '%' . $request->search . '%');
        }
        
        $pesanans = $query->paginate(15)->withQueryString();
        
        return view('page_admin.riwayat_pesanan.index', compact('pesanans'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pesanan = Pesanan::with('user')->findOrFail($id);
        
        return view('page_admin.riwayat_pesanan.show', compact('pesanan'));
    }

    /**
     * Update the status of the specified resource.
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Pending,Diterima,Diproses,Selesai'
        ]);

        $pesanan = Pesanan::findOrFail($id);
        $pesanan->status = $request->status;
        $pesanan->save();

        return redirect()->route('daftar-riwayat-pesanan.show', $id)
            ->with('success', 'Status pesanan berhasil diubah menjadi ' . $request->status);
    }
}

