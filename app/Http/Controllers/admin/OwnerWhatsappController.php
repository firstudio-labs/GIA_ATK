<?php

namespace App\Http\Controllers\admin;

use App\Models\OwnerWhatsapp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class OwnerWhatsappController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ownerWhatsapps = OwnerWhatsapp::latest()->get();
        return view('page_admin.owner_whatsapp.index', compact('ownerWhatsapps'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('page_admin.owner_whatsapp.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Normalize nomor WA: remove non-digit, ensure starts with 628
        $noWa = preg_replace('/\D/', '', $request->no_wa);
        if (strpos($noWa, '628') !== 0) {
            if (strpos($noWa, '0') === 0) {
                $noWa = '62' . substr($noWa, 1);
            } elseif (strpos($noWa, '62') !== 0) {
                $noWa = '628' . $noWa;
            } else {
                $noWa = '628' . substr($noWa, 2);
            }
        }
        
        $request->merge(['no_wa' => $noWa]);

        $request->validate([
            'no_wa' => [
                'required',
                'string',
                'max:20',
                'regex:/^628\d+$/',
            ],
            'template_pesan' => 'required|string',
        ], [
            'no_wa.required' => 'Nomor WhatsApp wajib diisi',
            'no_wa.regex' => 'Nomor WhatsApp harus dimulai dengan 628',
            'no_wa.max' => 'Nomor WhatsApp maksimal 20 karakter',
            'template_pesan.required' => 'Template pesan wajib diisi',
        ]);

        try {
            OwnerWhatsapp::create([
                'no_wa' => $request->no_wa,
                'template_pesan' => $request->template_pesan,
            ]);

            Alert::toast('Data owner WhatsApp berhasil disimpan', 'success')->position('top-end');
            return redirect()->route('owner-whatsapp.index');
        } catch (\Exception $e) {
            Log::error('Error storing OwnerWhatsapp: ' . $e->getMessage());
            Alert::toast('Terjadi kesalahan saat menyimpan data', 'error')->position('top-end');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(OwnerWhatsapp $ownerWhatsapp)
    {
        return view('page_admin.owner_whatsapp.show', compact('ownerWhatsapp'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OwnerWhatsapp $ownerWhatsapp)
    {
        return view('page_admin.owner_whatsapp.edit', compact('ownerWhatsapp'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OwnerWhatsapp $ownerWhatsapp)
    {
        // Normalize nomor WA: remove non-digit, ensure starts with 628
        $noWa = preg_replace('/\D/', '', $request->no_wa);
        if (strpos($noWa, '628') !== 0) {
            if (strpos($noWa, '0') === 0) {
                $noWa = '62' . substr($noWa, 1);
            } elseif (strpos($noWa, '62') !== 0) {
                $noWa = '628' . $noWa;
            } else {
                $noWa = '628' . substr($noWa, 2);
            }
        }
        
        $request->merge(['no_wa' => $noWa]);

        $request->validate([
            'no_wa' => [
                'required',
                'string',
                'max:20',
                'regex:/^628\d+$/',
            ],
            'template_pesan' => 'required|string',
        ], [
            'no_wa.required' => 'Nomor WhatsApp wajib diisi',
            'no_wa.regex' => 'Nomor WhatsApp harus dimulai dengan 628',
            'no_wa.max' => 'Nomor WhatsApp maksimal 20 karakter',
            'template_pesan.required' => 'Template pesan wajib diisi',
        ]);

        try {
            $ownerWhatsapp->update([
                'no_wa' => $request->no_wa,
                'template_pesan' => $request->template_pesan,
            ]);

            Alert::toast('Data owner WhatsApp berhasil diperbarui', 'success')->position('top-end');
            return redirect()->route('owner-whatsapp.index');
        } catch (\Exception $e) {
            Log::error('Error updating OwnerWhatsapp: ' . $e->getMessage());
            Alert::toast('Terjadi kesalahan saat memperbarui data', 'error')->position('top-end');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OwnerWhatsapp $ownerWhatsapp)
    {
        try {
            $ownerWhatsapp->delete();
            Alert::toast('Data owner WhatsApp berhasil dihapus', 'success')->position('top-end');
            return redirect()->route('owner-whatsapp.index');
        } catch (\Exception $e) {
            Log::error('Error deleting OwnerWhatsapp: ' . $e->getMessage());
            Alert::toast('Terjadi kesalahan saat menghapus data', 'error')->position('top-end');
            return redirect()->back();
        }
    }
}
