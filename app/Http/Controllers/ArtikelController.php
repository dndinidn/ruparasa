<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArtikelController extends Controller
{
    // Menampilkan semua artikel
<<<<<<< HEAD
    public function index(Request $request)
{
    $query = Artikel::orderBy('created_at', 'desc');

    if ($request->has('search') && $request->search != '') {
        $keyword = $request->search;
        $query->where('judul', 'like', "%{$keyword}%");
    }

    $artikels = $query->get();

    return view('admin.pustaka.artikel.index', compact('artikels'));
}


=======
    public function index()
    {
        $artikels = Artikel::orderBy('created_at', 'desc')->get();
        return view('admin.pustaka.artikel.index', compact('artikels'));
    }

>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a
    

    // Menampilkan form tambah
    public function create()
    {
        return view('admin.pustaka.artikel.tambah');
    }

    // Simpan artikel baru
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:100',
            'tanggal_publikasi' => 'required|date',
            'gambar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'deskripsi' => 'required|string',
        ]);

        // Simpan gambar ke storage/public/artikel
        $path = $request->file('gambar')->store('artikel', 'public');

        Artikel::create([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'tanggal_publikasi' => $request->tanggal_publikasi,
            'gambar' => $path,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil ditambahkan!');
    }

    // 🖋️ Menampilkan form edit (PERBAIKAN)
    public function edit(Artikel $artikel)
    {
        // menggunakan Route Model Binding agar lebih bersih
        return view('admin.pustaka.artikel.edit', compact('artikel'));
    }

    // Update data artikel
    public function update(Request $request, $id)
    {
        $artikel = Artikel::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:100',
            'tanggal_publikasi' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'deskripsi' => 'required|string',
        ]);

        $data = $request->only(['judul', 'penulis', 'tanggal_publikasi', 'deskripsi']);

        // Jika ada gambar baru
        if ($request->hasFile('gambar')) {
            // hapus gambar lama
            if ($artikel->gambar && Storage::disk('public')->exists($artikel->gambar)) {
                Storage::disk('public')->delete($artikel->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('artikel', 'public');
        }

        $artikel->update($data);

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil diperbarui!');
    }

    // Hapus artikel
    public function destroy($id)
    {
        $artikel = Artikel::findOrFail($id);

        if ($artikel->gambar && Storage::disk('public')->exists($artikel->gambar)) {
            Storage::disk('public')->delete($artikel->gambar);
        }

        $artikel->delete();

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil dihapus!');
    }

        public function indexuser()
    {
        $artikels = Artikel::latest()->get();
        return view('dashboard.artikel', compact('artikels'));
    }

    public function show($id)
{
    $artikel = Artikel::findOrFail($id);
    return view('admin.pustaka.artikel.show', compact('artikel'));
}

    
}
