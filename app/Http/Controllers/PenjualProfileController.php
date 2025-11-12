<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PenjualProfileController extends Controller
{
    
    public function edit(Request $request)
    {
        $user = $request->user();

        // buat record penjual jika belum ada (sekali saja)
        $penjual = $user->penjual()->firstOrCreate([
            'user_id' => $user->id,
        ], [
            'nama_toko' => $user->name ?? 'Toko Saya',
            'alamat'   => null,
            'kontak'   => null,
        ]);

        return view('penjual.editprofil', compact('penjual'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'nama_toko' => ['required','string','max:255'],
            'alamat'    => ['nullable','string','max:255'],
            'kontak'    => ['nullable','string','max:100'],
        ]);

        $penjual = $request->user()->penjual;
        $penjual->update($data);

        return redirect()
            ->route('penjual.editprofil')
            ->with('success', 'Profil toko berhasil diperbarui.');
    }
}
