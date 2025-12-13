<?php

namespace App\Http\Controllers\admin;

use App\Models\ManageSection;
use App\Models\ManageProduk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class ManageSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = ManageSection::latest()->get();
        return view('page_admin.manage_section.index', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $produks = ManageProduk::select('id', 'judul')->orderBy('judul')->get();
        return view('page_admin.manage_section.create', compact('produks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'product_ids' => ['nullable', 'array'],
            'product_ids.*' => ['integer', 'exists:manage_produks,id'],
            'discount_percentage' => ['nullable', 'integer', 'between:0,100'],
            'is_new' => ['nullable', 'boolean'],
        ]);

        $data = [
            'name' => $validated['name'],
            'product_ids' => $validated['product_ids'] ?? [],
            'discount_percentage' => $validated['discount_percentage'] ?? null,
            'is_new' => (bool) ($validated['is_new'] ?? false),
        ];

        ManageSection::create($data);
        Alert::toast('Section berhasil dibuat', 'success')->position('top-end');
        return redirect()->route('manage-section.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(ManageSection $manageSection)
    {
        $produkList = [];
        if (is_array($manageSection->product_ids) && count($manageSection->product_ids)) {
            $produkList = ManageProduk::whereIn('id', $manageSection->product_ids)
                ->select('id', 'judul')
                ->orderBy('judul')
                ->get();
        }
        return view('page_admin.manage_section.show', [
            'section' => $manageSection,
            'produkList' => $produkList,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ManageSection $manageSection)
    {
        $produks = ManageProduk::select('id', 'judul')->orderBy('judul')->get();
        return view('page_admin.manage_section.edit', [
            'section' => $manageSection,
            'produks' => $produks,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ManageSection $manageSection)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'product_ids' => ['nullable', 'array'],
            'product_ids.*' => ['integer', 'exists:manage_produks,id'],
            'discount_percentage' => ['nullable', 'integer', 'between:0,100'],
            'is_new' => ['nullable', 'boolean'],
        ]);

        $manageSection->update([
            'name' => $validated['name'],
            'product_ids' => $validated['product_ids'] ?? [],
            'discount_percentage' => $validated['discount_percentage'] ?? null,
            'is_new' => (bool) ($validated['is_new'] ?? false),
        ]);

        Alert::toast('Section berhasil diperbarui', 'success')->position('top-end');
        return redirect()->route('manage-section.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ManageSection $manageSection)
    {
        $manageSection->delete();
        Alert::toast('Section berhasil dihapus', 'success')->position('top-end');
        return redirect()->route('manage-section.index');
    }
}
