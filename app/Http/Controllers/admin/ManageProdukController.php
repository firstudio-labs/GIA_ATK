<?php

namespace App\Http\Controllers\admin;

use App\Models\ManageProduk;
use App\Models\ManageKategori;
use App\Models\ManageSubKategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class ManageProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produks = ManageProduk::with(['kategori','subKategori'])->latest()->get();
        return view('page_admin.manage_produk.index', compact('produks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = ManageKategori::orderBy('nama_kategori')->get();
        return view('page_admin.manage_produk.create', compact('kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255|min:3',
            'kategori_id' => 'required|exists:manage_kategoris,id',
            'sub_kategori_id' => 'required|exists:manage_sub_kategoris,id',
            'model' => 'nullable|array|max:20',
            'model.*' => 'nullable|string|max:100|distinct',
            'tags' => 'nullable|array|max:30',
            'tags.*' => 'nullable|string|max:50|distinct',
            'harga' => 'required|numeric|min:0|max:999999999',
            'diskon' => 'nullable|integer|min:0|max:100',
            'sku' => 'required|string|max:100|min:2|unique:manage_produks,sku',
            'deskripsi' => 'required|string|min:10|max:5000',
            'detail_produk' => 'nullable|string|max:10000',
            'status' => 'required|in:aktif,nonaktif',
            'berat' => 'nullable|numeric|min:0|max:1000',
            'ukuran' => 'nullable|string|max:100',
            'warna' => 'nullable|string|max:100',
            'gambar_produk' => 'nullable|array|min:1|max:10',
            'gambar_produk.*' => 'required|file|mimes:jpg,jpeg,png,gif,webp|max:3072|dimensions:min_width=100,min_height=100,max_width=5000,max_height=5000',
        ], [
            'judul.required' => 'Judul produk wajib diisi',
            'judul.min' => 'Judul produk minimal 3 karakter',
            'judul.max' => 'Judul produk maksimal 255 karakter',
            'kategori_id.required' => 'Kategori wajib dipilih',
            'kategori_id.exists' => 'Kategori tidak valid',
            'sub_kategori_id.required' => 'Sub kategori wajib dipilih',
            'sub_kategori_id.exists' => 'Sub kategori tidak valid',
            'model.max' => 'Maksimal 20 model produk',
            'model.*.max' => 'Setiap model maksimal 100 karakter',
            'model.*.distinct' => 'Model tidak boleh duplikat',
            'tags.max' => 'Maksimal 30 tag produk',
            'tags.*.max' => 'Setiap tag maksimal 50 karakter',
            'tags.*.distinct' => 'Tag tidak boleh duplikat',
            'harga.required' => 'Harga produk wajib diisi',
            'harga.min' => 'Harga tidak boleh negatif',
            'harga.max' => 'Harga terlalu besar',
            'diskon.max' => 'Diskon maksimal 100%',
            'sku.required' => 'SKU wajib diisi',
            'sku.min' => 'SKU minimal 2 karakter',
            'sku.max' => 'SKU maksimal 100 karakter',
            'sku.unique' => 'SKU sudah digunakan produk lain',
            'deskripsi.required' => 'Deskripsi produk wajib diisi',
            'deskripsi.min' => 'Deskripsi minimal 10 karakter',
            'deskripsi.max' => 'Deskripsi maksimal 5000 karakter',
            'detail_produk.max' => 'Detail produk maksimal 10000 karakter',
            'status.required' => 'Status produk wajib dipilih',
            'status.in' => 'Status tidak valid',
            'berat.min' => 'Berat tidak boleh negatif',
            'berat.max' => 'Berat maksimal 1000 kg',
            'ukuran.max' => 'Ukuran maksimal 100 karakter',
            'warna.max' => 'Warna maksimal 100 karakter',
            'gambar_produk.min' => 'Minimal 1 gambar produk',
            'gambar_produk.max' => 'Maksimal 10 gambar produk',
            'gambar_produk.*.required' => 'File gambar wajib dipilih',
            'gambar_produk.*.mimes' => 'Format gambar harus JPG, JPEG, PNG, GIF, atau WebP',
            'gambar_produk.*.max' => 'Ukuran gambar maksimal 3MB',
            'gambar_produk.*.dimensions' => 'Dimensi gambar minimal 100x100px dan maksimal 5000x5000px',
        ]);

        try {
            $slug = Str::slug($request->judul . '-' . Str::random(6));
            $gambarPaths = [];

            if ($request->hasFile('gambar_produk')) {
                foreach ($request->file('gambar_produk') as $file) {
                    if (!$file) { continue; }
                    $filename = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
                    $targetDir = public_path('produk/gambar');
                    if (!is_dir($targetDir)) { @mkdir($targetDir, 0755, true); }
                    $file->move($targetDir, $filename);
                    $gambarPaths[] = $filename;
                }
            }

            ManageProduk::create([
                'slug' => $slug,
                'judul' => $request->judul,
                'kategori_id' => $request->kategori_id,
                'sub_kategori_id' => $request->sub_kategori_id,
                'model' => $request->filled('model') && is_array($request->model) ? array_filter($request->model) : null,
                'tags' => $request->filled('tags') && is_array($request->tags) ? array_filter($request->tags) : null,
                'gambar_produk' => !empty($gambarPaths) ? $gambarPaths : null,
                'harga' => $request->harga,
                'diskon' => $request->diskon,
                'sku' => $request->sku,
                'deskripsi' => $request->deskripsi,
                'detail_produk' => $request->detail_produk,
                'status' => $request->status,
                'berat' => $request->berat,
                'ukuran' => $request->ukuran,
                'warna' => $request->warna,
            ]);

            Alert::toast('Produk berhasil disimpan', 'success')->position('top-end');
            return redirect()->route('manage-produk.index');
        } catch (\Exception $e) {
            Log::error('Error store produk: '.$e->getMessage());
            Alert::toast('Terjadi kesalahan saat menyimpan', 'error')->position('top-end');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ManageProduk $manageProduk)
    {
        $manageProduk->load(['kategori','subKategori']);
        return view('page_admin.manage_produk.show', compact('manageProduk'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ManageProduk $manageProduk)
    {
        $kategoris = ManageKategori::orderBy('nama_kategori')->get();
        $subKategoris = ManageSubKategori::where('kategori_id', $manageProduk->kategori_id)->orderBy('first_nama_sub_kategori')->get();
        return view('page_admin.manage_produk.edit', compact('manageProduk','kategoris','subKategoris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ManageProduk $manageProduk)
    {
        $request->validate([
            'judul' => 'required|string|max:255|min:3',
            'kategori_id' => 'required|exists:manage_kategoris,id',
            'sub_kategori_id' => 'required|exists:manage_sub_kategoris,id',
            'model' => 'nullable|array|max:20',
            'model.*' => 'nullable|string|max:100|distinct',
            'tags' => 'nullable|array|max:30',
            'tags.*' => 'nullable|string|max:50|distinct',
            'harga' => 'required|numeric|min:0|max:999999999',
            'diskon' => 'nullable|integer|min:0|max:100',
            'sku' => 'required|string|max:100|min:2|unique:manage_produks,sku,' . $manageProduk->id,
            'deskripsi' => 'required|string|min:10|max:5000',
            'detail_produk' => 'nullable|string|max:10000',
            'status' => 'required|in:aktif,nonaktif',
            'berat' => 'nullable|numeric|min:0|max:1000',
            'ukuran' => 'nullable|string|max:100',
            'warna' => 'nullable|string|max:100',
            'gambar_produk' => 'nullable|array|max:10',
            'gambar_produk.*' => 'nullable|file|mimes:jpg,jpeg,png,gif,webp|max:3072|dimensions:min_width=100,min_height=100,max_width=5000,max_height=5000',
            'hapus_gambar' => 'nullable|array',
            'hapus_gambar.*' => 'string',
        ], [
            'judul.required' => 'Judul produk wajib diisi',
            'judul.min' => 'Judul produk minimal 3 karakter',
            'judul.max' => 'Judul produk maksimal 255 karakter',
            'kategori_id.required' => 'Kategori wajib dipilih',
            'kategori_id.exists' => 'Kategori tidak valid',
            'sub_kategori_id.required' => 'Sub kategori wajib dipilih',
            'sub_kategori_id.exists' => 'Sub kategori tidak valid',
            'model.max' => 'Maksimal 20 model produk',
            'model.*.max' => 'Setiap model maksimal 100 karakter',
            'model.*.distinct' => 'Model tidak boleh duplikat',
            'tags.max' => 'Maksimal 30 tag produk',
            'tags.*.max' => 'Setiap tag maksimal 50 karakter',
            'tags.*.distinct' => 'Tag tidak boleh duplikat',
            'harga.required' => 'Harga produk wajib diisi',
            'harga.min' => 'Harga tidak boleh negatif',
            'harga.max' => 'Harga terlalu besar',
            'diskon.max' => 'Diskon maksimal 100%',
            'sku.required' => 'SKU wajib diisi',
            'sku.min' => 'SKU minimal 2 karakter',
            'sku.max' => 'SKU maksimal 100 karakter',
            'sku.unique' => 'SKU sudah digunakan produk lain',
            'deskripsi.required' => 'Deskripsi produk wajib diisi',
            'deskripsi.min' => 'Deskripsi minimal 10 karakter',
            'deskripsi.max' => 'Deskripsi maksimal 5000 karakter',
            'detail_produk.max' => 'Detail produk maksimal 10000 karakter',
            'status.required' => 'Status produk wajib dipilih',
            'status.in' => 'Status tidak valid',
            'berat.min' => 'Berat tidak boleh negatif',
            'berat.max' => 'Berat maksimal 1000 kg',
            'ukuran.max' => 'Ukuran maksimal 100 karakter',
            'warna.max' => 'Warna maksimal 100 karakter',
            'gambar_produk.max' => 'Maksimal 10 gambar produk',
            'gambar_produk.*.mimes' => 'Format gambar harus JPG, JPEG, PNG, GIF, atau WebP',
            'gambar_produk.*.max' => 'Ukuran gambar maksimal 3MB',
            'gambar_produk.*.dimensions' => 'Dimensi gambar minimal 100x100px dan maksimal 5000x5000px',
            'hapus_gambar.array' => 'Format data hapus gambar tidak valid',
            'hapus_gambar.*.string' => 'Nama file gambar harus berupa teks',
        ]);

        try {
            $gambarExisting = is_array($manageProduk->gambar_produk) ? $manageProduk->gambar_produk : [];

            // Hapus gambar yang dipilih
            if ($request->filled('hapus_gambar')) {
                foreach ($request->hapus_gambar as $filename) {
                    $path = public_path('produk/gambar/' . $filename);
                    if (is_file($path)) { @unlink($path); }
                    $gambarExisting = array_values(array_filter($gambarExisting, function($g) use ($filename){ return $g !== $filename; }));
                }
            }

            // Tambah gambar baru
            if ($request->hasFile('gambar_produk')) {
                foreach ($request->file('gambar_produk') as $file) {
                    if (!$file) { continue; }
                    $filename = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
                    $targetDir = public_path('produk/gambar');
                    if (!is_dir($targetDir)) { @mkdir($targetDir, 0755, true); }
                    $file->move($targetDir, $filename);
                    $gambarExisting[] = $filename;
                }
            }

            $manageProduk->update([
                'judul' => $request->judul,
                'kategori_id' => $request->kategori_id,
                'sub_kategori_id' => $request->sub_kategori_id,
                'model' => $request->filled('model') && is_array($request->model) ? array_filter($request->model) : null,
                'tags' => $request->filled('tags') && is_array($request->tags) ? array_filter($request->tags) : null,
                'gambar_produk' => !empty($gambarExisting) ? array_values($gambarExisting) : null,
                'harga' => $request->harga,
                'diskon' => $request->diskon,
                'sku' => $request->sku,
                'deskripsi' => $request->deskripsi,
                'detail_produk' => $request->detail_produk,
                'status' => $request->status,
                'berat' => $request->berat,
                'ukuran' => $request->ukuran,
                'warna' => $request->warna,
            ]);

            Alert::toast('Produk berhasil diperbarui', 'success')->position('top-end');
            return redirect()->route('manage-produk.index');
        } catch (\Exception $e) {
            Log::error('Error update produk: '.$e->getMessage());
            Alert::toast('Terjadi kesalahan saat memperbarui', 'error')->position('top-end');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ManageProduk $manageProduk)
    {
        try {
            // Hapus file gambar
            if (is_array($manageProduk->gambar_produk)) {
                foreach ($manageProduk->gambar_produk as $filename) {
                    $path = public_path('produk/gambar/' . $filename);
                    if (is_file($path)) { @unlink($path); }
                }
            }
            $manageProduk->delete();
            Alert::toast('Produk berhasil dihapus', 'success')->position('top-end');
            return redirect()->route('manage-produk.index');
        } catch (\Exception $e) {
            Log::error('Error delete produk: '.$e->getMessage());
            Alert::toast('Terjadi kesalahan saat menghapus', 'error')->position('top-end');
            return redirect()->back();
        }
    }

    // Endpoint AJAX: ambil sub kategori berdasarkan kategori
    public function subKategoriByKategori(Request $request)
    {
        $request->validate(['kategori_id' => 'required|exists:manage_kategoris,id']);
        $subs = ManageSubKategori::where('kategori_id', $request->kategori_id)
            ->orderBy('first_nama_sub_kategori')
            ->get(['id','first_nama_sub_kategori']);
        return response()->json($subs);
    }
}
