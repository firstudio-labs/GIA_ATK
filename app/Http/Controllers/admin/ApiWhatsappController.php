<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\WhatsappApi;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ApiWhatsappController extends Controller
{
    public function index()
    {
        $whatsappApi = WhatsappApi::first();
        return view('page_admin.api_whatsapp.index', compact('whatsappApi'));
    }

    public function storeorupdate(Request $request)
    {
        $whatsappApi = WhatsappApi::first();

        if ($whatsappApi) {
            // Update jika data sudah ada
            $whatsappApi->update($request->all());
            Alert::toast('Whatsapp Api berhasil diubah', 'success')->position('top-end');
        } else {
            // Create jika data belum ada
            WhatsappApi::create($request->all());
            Alert::toast('Whatsapp Api berhasil ditambahkan', 'success')->position('top-end');
        }

        return redirect()->route('whatsapp-api.index');
    }
}