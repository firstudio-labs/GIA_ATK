<?php

namespace App\Http\Controllers\admin;

use App\Models\ManageArtikel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ManageArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $artikels = ManageArtikel::latest()->get();
        return view('page_admin.manage_artikel.index', compact('artikels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('page_admin.manage_artikel.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'isi' => ['nullable', 'string'],
            'gambar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'status' => ['required', 'in:aktif,nonaktif'],
        ]);

        $slug = $this->generateUniqueSlug($validated['judul']);
        $filename = null;

        if ($request->hasFile('gambar')) {
            $dir = public_path('artikel/gambar');
            if (!File::exists($dir)) {
                File::makeDirectory($dir, 0755, true);
            }
            $extension = $request->file('gambar')->getClientOriginalExtension();
            $base = Str::slug(pathinfo($request->file('gambar')->getClientOriginalName(), PATHINFO_FILENAME));
            $filename = time() . '_' . $base . '.' . $extension;
            $request->file('gambar')->move($dir, $filename);
        }

        ManageArtikel::create([
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'] ?? null,
            'isi' => $validated['isi'] ?? null,
            'gambar' => $filename,
            'slug' => $slug,
            'status' => $validated['status'],
        ]);

        Alert::toast('Artikel berhasil dibuat', 'success')->position('top-end');
        return redirect()->route('manage-artikel.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(ManageArtikel $manageArtikel)
    {
        return view('page_admin.manage_artikel.show', ['artikel' => $manageArtikel]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ManageArtikel $manageArtikel)
    {
        return view('page_admin.manage_artikel.edit', ['artikel' => $manageArtikel]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ManageArtikel $manageArtikel)
    {
        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'isi' => ['nullable', 'string'],
            'gambar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'status' => ['required', 'in:aktif,nonaktif'],
        ]);

        $data = [
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'] ?? null,
            'isi' => $validated['isi'] ?? null,
            'status' => $validated['status'],
        ];

        if ($manageArtikel->judul !== $validated['judul']) {
            $data['slug'] = $this->generateUniqueSlug($validated['judul'], $manageArtikel->id);
        }

        if ($request->hasFile('gambar')) {
            $dir = public_path('artikel/gambar');
            if (!File::exists($dir)) {
                File::makeDirectory($dir, 0755, true);
            }

            if (!empty($manageArtikel->gambar)) {
                $oldPath = $dir . DIRECTORY_SEPARATOR . $manageArtikel->gambar;
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }
            }

            $extension = $request->file('gambar')->getClientOriginalExtension();
            $base = Str::slug(pathinfo($request->file('gambar')->getClientOriginalName(), PATHINFO_FILENAME));
            $filename = time() . '_' . $base . '.' . $extension;
            $request->file('gambar')->move($dir, $filename);
            $data['gambar'] = $filename;
        }

        $manageArtikel->update($data);

        Alert::toast('Artikel berhasil diperbarui', 'success')->position('top-end');
        return redirect()->route('manage-artikel.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ManageArtikel $manageArtikel)
    {
        if (!empty($manageArtikel->gambar)) {
            $path = public_path('artikel/gambar/' . $manageArtikel->gambar);
            if (File::exists($path)) {
                File::delete($path);
            }
        }

        $manageArtikel->delete();

        Alert::toast('Artikel berhasil dihapus', 'success')->position('top-end');
        return redirect()->route('manage-artikel.index');
    }

    private function generateUniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($title);
        $slug = $baseSlug;
        $counter = 1;

        while (ManageArtikel::where('slug', $slug)
                ->when($ignoreId, fn($query) => $query->where('id', '!=', $ignoreId))
                ->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
