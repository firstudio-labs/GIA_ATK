<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Profil;
use App\Mail\KontakMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class KontakWebController extends Controller
{
    public function index()
    {
        $profil = Profil::first();
        $hcaptchaSiteKey = env('HCAPTCHA_SITE_KEY');
        return view('page_web.kontak.index', compact('profil', 'hcaptchaSiteKey'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subjek' => 'required|string|max:255',
            'pesan' => 'required|string',
            'h-captcha-response' => 'required',
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'subjek.required' => 'Subjek wajib diisi.',
            'pesan.required' => 'Pesan wajib diisi.',
            'h-captcha-response.required' => 'Silakan verifikasi hCaptcha terlebih dahulu.',
        ]);

        if ($validator->fails()) {
            Alert::toast('Terjadi kesalahan!', 'error')->position('top-end');
            return redirect()->back()->withErrors($validator)->withInput()->with('error', $validator->errors()->first());
        }

        // Verifikasi hCaptcha
        $hCaptchaResponse = $request->input('h-captcha-response');
        $secret = env('HCAPTCHA_SECRET_KEY');
        
        if (!$secret) {
            Alert::toast('Konfigurasi hCaptcha belum lengkap.', 'error')->position('top-end');
            return redirect()->back()->withInput();
        }

        try {
            $verify = file_get_contents("https://hcaptcha.com/siteverify?secret={$secret}&response={$hCaptchaResponse}");
            $captchaSuccess = json_decode($verify);

            if (!isset($captchaSuccess->success) || !$captchaSuccess->success) {
                Alert::toast('Verifikasi hCaptcha gagal. Silakan coba lagi.', 'error')->position('top-end');
                return redirect()->back()->withInput();
            }
        } catch (\Exception $e) {
            Alert::toast('Terjadi kesalahan saat verifikasi hCaptcha. Silakan coba lagi.', 'error')->position('top-end');
            return redirect()->back()->withInput();
        }

        // Ambil data profil
        $profil = Profil::first();
        
        if (!$profil || !$profil->email_perusahaan) {
            Alert::toast('Email perusahaan belum dikonfigurasi.', 'error')->position('top-end');
            return redirect()->back()->withInput();
        }

        try {
            // Kirim email
            Mail::to($profil->email_perusahaan)->send(new KontakMail([
                'nama' => $request->nama,
                'email' => $request->email,
                'subjek' => $request->subjek,
                'pesan' => $request->pesan,
            ]));

            Alert::toast('Pesan Anda telah terkirim. Kami akan segera menghubungi Anda.', 'success')->position('top-end');
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::toast('Terjadi kesalahan saat mengirim pesan. Silakan coba lagi nanti.', 'error')->position('top-end');
            return redirect()->back()->withInput();
        }
    }
}

