<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
{
    $penjual = auth()->user()->penjual;

    $query = Produk::where('penjual_id', $penjual->id);

    // 🔍 Jika ada kata pencarian
    if (request()->has('search')) {
        $search = request()->search;

        $query->where(function($q) use ($search) {
            $q->where('nama_produk', 'like', "%$search%")
              ->orWhere('kategori', 'like', "%$search%");
        });
    }

    $produks = $query->orderBy('created_at', 'desc')->get();

    return view('penjual.lihatproduk', compact('produks'));
}


    public function create()
    {
        return view('penjual.tambahproduk');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga'       => 'required|numeric|min:0',
            'stok'        => 'required|integer|min:0',
            'deskripsi'   => 'required|string',
            'kategori'    => 'required|string',
            'gambar'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = Auth::user();

        if (!$user->penjual) {
            return back()->with('error', 'Akun penjual belum terdaftar.');
        }

        $path = $request->hasFile('gambar')
            ? $request->file('gambar')->store('gambar_produk', 'public')
            : null;

        Produk::create([
            'penjual_id'   => $user->penjual->id,
            'nama_produk'  => $request->nama_produk,
            'harga'        => $request->harga,
            'stok'         => $request->stok,
            'deskripsi'    => $request->deskripsi,
            'kategori'     => $request->kategori,   // <── SIMPAN KATEGORI
            'gambar'       => $path,
        ]);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $user = Auth::user();

        $produk = Produk::where('id', $id)
                        ->where('penjual_id', $user->penjual->id)
                        ->firstOrFail();

        return view('penjual.editproduk', compact('produk'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga'       => 'required|numeric|min:0',
            'stok'        => 'required|integer|min:0',
            'deskripsi'   => 'required|string',
            'kategori'    => 'required|string',
            'gambar'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = Auth::user();

        $produk = Produk::where('id', $id)
                        ->where('penjual_id', $user->penjual->id)
                        ->firstOrFail();

        $data = $request->only(['nama_produk', 'harga', 'stok', 'deskripsi', 'kategori']);

        if ($request->hasFile('gambar')) {
            if ($produk->gambar && Storage::exists('public/' . $produk->gambar)) {
                Storage::delete('public/' . $produk->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('gambar_produk', 'public');
        }

        $produk->update($data);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $user = Auth::user();

        $produk = Produk::where('id', $id)
                        ->where('penjual_id', $user->penjual->id)
                        ->firstOrFail();

        if ($produk->gambar && Storage::exists('public/' . $produk->gambar)) {
            Storage::delete('public/' . $produk->gambar);
        }

        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus!');
    }

    public function show($id)
    {
        $produk = Produk::findOrFail($id);
        return view('penjual.detailProduk', compact('produk'));
    }
}
