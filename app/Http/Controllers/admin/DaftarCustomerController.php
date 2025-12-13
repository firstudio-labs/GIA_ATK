<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class DaftarCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::where('role', 'user')->withCount('pesanans');
        
        // Pencarian berdasarkan nama, email, atau username
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%')
                  ->orWhere('username', 'like', '%' . $search . '%')
                  ->orWhere('no_wa', 'like', '%' . $search . '%');
            });
        }
        
        $customers = $query->latest()->paginate(15)->withQueryString();
        
        return view('page_admin.daftar_customer.index', compact('customers'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $customer = User::where('role', 'user')
            ->withCount('pesanans')
            ->with(['pesanans' => function($query) {
                $query->latest()->take(10);
            }])
            ->findOrFail($id);
        
        // Hitung statistik pesanan
        $totalPesanan = Pesanan::where('user_id', $id)->count();
        $totalBelanja = Pesanan::where('user_id', $id)->sum('total');
        $pesananTerbaru = Pesanan::where('user_id', $id)->latest()->take(5)->get();
        
        return view('page_admin.daftar_customer.show', compact('customer', 'totalPesanan', 'totalBelanja', 'pesananTerbaru'));
    }
}

