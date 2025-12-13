<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Profil;
use App\Models\ManageLayanan;
use App\Models\OwnerWhatsapp;

class AboutController extends Controller
{
    public function index()
    {
        $profil = Profil::first();
        $ownerWhatsapp = OwnerWhatsapp::first();
        return view('page_web.about.index', compact('profil', 'ownerWhatsapp'));
    }
}