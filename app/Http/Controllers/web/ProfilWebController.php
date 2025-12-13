<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProfilWebController extends Controller
{
    public function index()
    {
        $data = User::where('id', auth()->user()->id)->first();
        return view('page_web.profil.profil', compact('data'));
    }

    public function update(Request $request)
    {
        $user = User::find(auth()->user()->id);

        $validator = Validator::make($request->all(), [
            'foto_profile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|max:255', 
            'email' => 'required|email|unique:users,email,' . $user->id,
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'no_wa' => 'required|string|max:20',
        ]);

        if($validator->fails()) {
            Alert::toast('Terjadi kesalahan saat mengupdate profil!', 'error')->position('top-end');
            return redirect()->back()->withErrors($validator)->withInput()->with('error', $validator->errors()->first());
        }

        $data = $request->except(['password', 'foto_profile', '_token', '_method']);

        // Proses upload foto_profile
        if ($request->hasFile('foto_profile')) {
            $file = $request->file('foto_profile');
            $filename = 'profile_' . time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            
            // Pastikan folder ada
            $path = public_path('uploads/foto_profile');
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            
            $file->move($path, $filename);

            // Hapus foto lama jika ada
            if ($user->foto_profile && file_exists(public_path('uploads/foto_profile/' . $user->foto_profile))) {
                @unlink(public_path('uploads/foto_profile/' . $user->foto_profile));
            }

            $data['foto_profile'] = $filename;
        }

        $user->update($data);
        Alert::toast('Profil berhasil diperbarui.', 'success')->position('top-end');
        return redirect()->back();
    }

    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        if($validator->fails()) {
            Alert::toast('Terjadi kesalahan saat mengupdate password!', 'error')->position('top-end');
            return redirect()->back()->withErrors($validator)->withInput()->with('error', $validator->errors()->first());
        }

        $user = User::find(auth()->user()->id);

        // Cek password lama
        if (!Hash::check($request->current_password, $user->password)) {
            Alert::toast('Password lama tidak sesuai.', 'error')->position('top-end');
            return redirect()->back();
        }

        // Update password baru
        $user->update([
            'password' => Hash::make($request->password)
        ]);

        Alert::toast('Password berhasil diubah.', 'success')->position('top-end');
        return redirect()->back();
    }
}