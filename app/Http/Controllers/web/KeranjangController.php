<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Keranjang;
use App\Models\ManageProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    /**
     * Get cart items for sidebar (AJAX)
     */
    public function getCart()
    {
        if (!Auth::check()) {
            return response()->json(['items' => [], 'subtotal' => 0]);
        }

        $keranjangs = Keranjang::where('user_id', Auth::id())
            ->with('produk')
            ->get();

        $items = [];
        $subtotal = 0;

        foreach ($keranjangs as $keranjang) {
            $produk = $keranjang->produk;
            if ($produk) {
                $gambar = is_array($produk->gambar_produk) && count($produk->gambar_produk) > 0 
                    ? asset('produk/gambar/' . $produk->gambar_produk[0])
                    : asset('web/assets/img/shop/01.jpg');

                $harga = $produk->diskon > 0 
                    ? $produk->harga - ($produk->harga * $produk->diskon / 100)
                    : $produk->harga;

                $items[] = [
                    'id' => $keranjang->id,
                    'produk_id' => $produk->id,
                    'slug' => $produk->slug,
                    'judul' => $produk->judul,
                    'gambar' => $gambar,
                    'harga' => $harga,
                    'quantity' => $keranjang->quantity,
                    'total' => $harga * $keranjang->quantity,
                ];

                $subtotal += $harga * $keranjang->quantity;
            }
        }

        return response()->json([
            'items' => $items,
            'subtotal' => $subtotal,
            'count' => count($items)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Silakan login terlebih dahulu'
            ], 401);
        }

        try {
        $request->validate([
            'produk_id' => 'required|exists:manage_produks,id',
                'quantity' => 'required|integer|min:1|max:999',
            ], [
                'produk_id.required' => 'Produk ID harus diisi',
                'produk_id.exists' => 'Produk tidak ditemukan',
                'quantity.required' => 'Jumlah harus diisi',
                'quantity.integer' => 'Jumlah harus berupa angka',
                'quantity.min' => 'Jumlah minimal 1',
                'quantity.max' => 'Jumlah maksimal 999',
        ]);

        $produk = ManageProduk::findOrFail($request->produk_id);

        // Hitung harga dengan diskon jika ada
        $harga = $produk->diskon > 0 
            ? $produk->harga - ($produk->harga * $produk->diskon / 100)
            : $produk->harga;

        // Cek apakah produk sudah ada di keranjang
        $keranjang = Keranjang::where('user_id', Auth::id())
            ->where('produk_id', $request->produk_id)
            ->first();

        if ($keranjang) {
            // Update quantity jika sudah ada
            $keranjang->quantity += $request->quantity;
            $keranjang->harga = $harga;
            $keranjang->save();
                
                $message = 'Jumlah produk di keranjang berhasil diperbarui';
        } else {
            // Buat baru jika belum ada
            Keranjang::create([
                'user_id' => Auth::id(),
                'produk_id' => $request->produk_id,
                'quantity' => $request->quantity,
                'harga' => $harga,
            ]);
                
                $message = 'Produk berhasil ditambahkan ke keranjang';
        }

        return response()->json([
            'success' => true,
                'message' => $message
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Keranjang $keranjang)
    {
        if (!Auth::check() || $keranjang->user_id != Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $keranjang->quantity = $request->quantity;
        $keranjang->save();

        return response()->json([
            'success' => true,
            'message' => 'Keranjang berhasil diperbarui'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Keranjang $keranjang)
    {
        if (!Auth::check() || $keranjang->user_id != Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        $keranjang->delete();

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil dihapus dari keranjang'
        ]);
    }
}
