<?php

namespace App\Http\Controllers\admin;

use App\Models\ManageKategori;
use App\Models\ManageSubKategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;

class ManageSubKategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subKategoris = ManageSubKategori::with('kategori')->latest()->get();
        return view('page_admin.manage_kategori.sub_kategori.index', compact('subKategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = ManageKategori::orderBy('nama_kategori')->get();
        return view('page_admin.manage_kategori.sub_kategori.create', compact('kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|exists:manage_kategoris,id',
            'first_nama_sub_kategori' => 'required|string|max:255',
            'second_nama_sub_kategori' => 'nullable|string|max:255',
        ]);

        try {
            ManageSubKategori::create([
                'kategori_id' => $request->kategori_id,
                'first_nama_sub_kategori' => $request->first_nama_sub_kategori,
                'second_nama_sub_kategori' => $request->second_nama_sub_kategori,
            ]);

            Alert::toast('Data sub kategori berhasil disimpan', 'success')->position('top-end');
            return redirect()->route('manage-sub-kategori.index');
        } catch (\Exception $e) {
            Log::error('Error storing ManageSubKategori: ' . $e->getMessage());
            Alert::toast('Terjadi kesalahan saat menyimpan data', 'error')->position('top-end');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ManageSubKategori $manageSubKategori)
    {
        $manageSubKategori->load('kategori');
        return view('page_admin.manage_kategori.sub_kategori.show', compact('manageSubKategori'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ManageSubKategori $manageSubKategori)
    {
        $kategoris = ManageKategori::orderBy('nama_kategori')->get();
        return view('page_admin.manage_kategori.sub_kategori.edit', compact('manageSubKategori', 'kategoris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ManageSubKategori $manageSubKategori)
    {
        $request->validate([
            'kategori_id' => 'required|exists:manage_kategoris,id',
            'first_nama_sub_kategori' => 'required|string|max:255',
            'second_nama_sub_kategori' => 'nullable|string|max:255',
        ]);

        try {
            $manageSubKategori->update([
                'kategori_id' => $request->kategori_id,
                'first_nama_sub_kategori' => $request->first_nama_sub_kategori,
                'second_nama_sub_kategori' => $request->second_nama_sub_kategori,
            ]);

            Alert::toast('Data sub kategori berhasil diperbarui', 'success')->position('top-end');
            return redirect()->route('manage-sub-kategori.index');
        } catch (\Exception $e) {
            Log::error('Error updating ManageSubKategori: ' . $e->getMessage());
            Alert::toast('Terjadi kesalahan saat memperbarui data', 'error')->position('top-end');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ManageSubKategori $manageSubKategori)
    {
        try {
            $manageSubKategori->delete();
            Alert::toast('Data sub kategori berhasil dihapus', 'success')->position('top-end');
            return redirect()->route('manage-sub-kategori.index');
        } catch (\Exception $e) {
            Log::error('Error deleting ManageSubKategori: ' . $e->getMessage());
            Alert::toast('Terjadi kesalahan saat menghapus data', 'error')->position('top-end');
            return redirect()->back();
        }
    }
}
