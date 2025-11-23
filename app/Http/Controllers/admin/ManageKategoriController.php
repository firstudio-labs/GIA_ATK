<?php

namespace App\Http\Controllers\admin;

use App\Models\ManageKategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;

class ManageKategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategoris = ManageKategori::latest()->get();
        return view('page_admin.manage_kategori.kategori.index', compact('kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('page_admin.manage_kategori.kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        try {
            ManageKategori::create([
                'nama_kategori' => $request->nama_kategori,
                'deskripsi' => $request->deskripsi,
            ]);

            Alert::toast('Data kategori berhasil disimpan', 'success')->position('top-end');
            return redirect()->route('manage-kategori.index');
        } catch (\Exception $e) {
            Log::error('Error storing ManageKategori: ' . $e->getMessage());
            Alert::toast('Terjadi kesalahan saat menyimpan data', 'error')->position('top-end');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ManageKategori $manageKategori)
    {
        return view('page_admin.manage_kategori.kategori.show', compact('manageKategori'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ManageKategori $manageKategori)
    {
        return view('page_admin.manage_kategori.kategori.edit', compact('manageKategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ManageKategori $manageKategori)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        try {
            $manageKategori->update([
                'nama_kategori' => $request->nama_kategori,
                'deskripsi' => $request->deskripsi,
            ]);

            Alert::toast('Data kategori berhasil diperbarui', 'success')->position('top-end');
            return redirect()->route('manage-kategori.index');
        } catch (\Exception $e) {
            Log::error('Error updating ManageKategori: ' . $e->getMessage());
            Alert::toast('Terjadi kesalahan saat memperbarui data', 'error')->position('top-end');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ManageKategori $manageKategori)
    {
        try {
            $manageKategori->delete();
            Alert::toast('Data kategori berhasil dihapus', 'success')->position('top-end');
            return redirect()->route('manage-kategori.index');
        } catch (\Exception $e) {
            Log::error('Error deleting ManageKategori: ' . $e->getMessage());
            Alert::toast('Terjadi kesalahan saat menghapus data', 'error')->position('top-end');
            return redirect()->back();
        }
    }
}
