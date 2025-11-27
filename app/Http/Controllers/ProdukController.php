<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
<<<<<<< HEAD
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
=======
    // 🔹 Tampilkan semua produk di dashboard penjual
    // public function index()
    // {
    //     /** @var \App\Models\User $user */
    //     $user = Auth::user();

    //     if (!$user->penjual) {
    //         return redirect()->back()->with('error', 'Akun penjual belum terdaftar.');
    //     }

    //     $produks = Produk::where('penjual_id', $user->penjual->id)->get();
    //     return view('penjual.lihatproduk', compact('produks'));
    // }

//     public function index()
// {
//     // Tampilkan semua produk tanpa login
//     $produks = Produk::all(); // atau filter tertentu jika mau
//     return view('penjual.lihatproduk', compact('produks'));
// }
public function index()
{
    $penjual = auth()->user()->penjual; // pastikan profil penjual ada
    $produks = Produk::where('penjual_id', $penjual->id)
        ->orderBy('created_at', 'desc')
        ->get();
>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a

    return view('penjual.lihatproduk', compact('produks'));
}


<<<<<<< HEAD
=======
    // 🔹 Tampilkan form tambah produk
>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a
    public function create()
    {
        return view('penjual.tambahproduk');
    }

<<<<<<< HEAD
=======
    // 🔹 Simpan data produk ke database
>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga'       => 'required|numeric|min:0',
            'stok'        => 'required|integer|min:0',
            'deskripsi'   => 'required|string',
<<<<<<< HEAD
            'kategori'    => 'required|string',
            'gambar'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = Auth::user();

        if (!$user->penjual) {
            return back()->with('error', 'Akun penjual belum terdaftar.');
=======
            'gambar'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (!$user->penjual) {
            return back()->with('error', 'Akun penjual belum terdaftar di sistem.');
>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a
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
<<<<<<< HEAD
            'kategori'     => $request->kategori,   // <── SIMPAN KATEGORI
=======
>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a
            'gambar'       => $path,
        ]);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan!');
    }

<<<<<<< HEAD
    public function edit($id)
    {
=======
    // 🔹 Edit Produk
    public function edit($id)
    {
        /** @var \App\Models\User $user */
>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a
        $user = Auth::user();

        $produk = Produk::where('id', $id)
                        ->where('penjual_id', $user->penjual->id)
                        ->firstOrFail();

        return view('penjual.editproduk', compact('produk'));
    }

<<<<<<< HEAD
=======
    // 🔹 Update Produk
>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga'       => 'required|numeric|min:0',
            'stok'        => 'required|integer|min:0',
            'deskripsi'   => 'required|string',
<<<<<<< HEAD
            'kategori'    => 'required|string',
            'gambar'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

=======
            'gambar'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        /** @var \App\Models\User $user */
>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a
        $user = Auth::user();

        $produk = Produk::where('id', $id)
                        ->where('penjual_id', $user->penjual->id)
                        ->firstOrFail();

<<<<<<< HEAD
        $data = $request->only(['nama_produk', 'harga', 'stok', 'deskripsi', 'kategori']);

=======
        $data = $request->only(['nama_produk', 'harga', 'stok', 'deskripsi']);

        // Upload gambar baru jika ada
>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a
        if ($request->hasFile('gambar')) {
            if ($produk->gambar && Storage::exists('public/' . $produk->gambar)) {
                Storage::delete('public/' . $produk->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('gambar_produk', 'public');
        }

        $produk->update($data);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui!');
    }

<<<<<<< HEAD
    public function destroy($id)
    {
=======
    // 🔹 Hapus Produk
    public function destroy($id)
    {
        /** @var \App\Models\User $user */
>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a
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
<<<<<<< HEAD
    {
        $produk = Produk::findOrFail($id);
        return view('penjual.detailProduk', compact('produk'));
    }
=======
{
    $produk = Produk::findOrFail($id);
    return view('penjual.detailProduk', compact('produk'));
}

>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a
}
