<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    // Menampilkan semua buku
    public function index()
    {
        $bukus = Buku::orderBy('created_at', 'desc')->get();
        return view('admin.pustaka.buku.index', compact('bukus'));
    }

    // Form tambah
    public function create()
    {
        return view('admin.pustaka.buku.tambah');
    }

    // Simpan buku baru
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255', // validasi penulis
            'file_pdf' => 'required|mimes:pdf|max:102400', // max 10MB
            'deskripsi' => 'required|string',
        ]);

        $pdfPath = $request->file('file_pdf')->store('buku', 'public');

        Buku::create([
            'judul' => $request->judul,
            'penulis' => $request->penulis, // simpan penulis
            'file_pdf' => $pdfPath,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('admin.buku.index')->with('success', 'Buku berhasil ditambahkan!');
    }

    // Form edit
    public function edit(Buku $buku)
    {
        return view('admin.pustaka.buku.edit', compact('buku'));
    }

    // Update buku
    public function update(Request $request, Buku $buku)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255', // validasi penulis
            'file_pdf' => 'nullable|mimes:pdf|max:102400',
            'deskripsi' => 'required|string',
        ]);

        $data = $request->only(['judul', 'penulis', 'deskripsi']); // sertakan penulis

        if ($request->hasFile('file_pdf')) {
            if ($buku->file_pdf && Storage::disk('public')->exists($buku->file_pdf)) {
                Storage::disk('public')->delete($buku->file_pdf);
            }
            $data['file_pdf'] = $request->file('file_pdf')->store('buku', 'public');
        }

        $buku->update($data);

        return redirect()->route('admin.buku.index')->with('success', 'Buku berhasil diperbarui!');
    }

    // Hapus buku
    public function destroy(Buku $buku)
    {
        if ($buku->file_pdf && Storage::disk('public')->exists($buku->file_pdf)) {
            Storage::disk('public')->delete($buku->file_pdf);
        }

        $buku->delete();

        return redirect()->route('admin.buku.index')->with('success', 'Buku berhasil dihapus!');
    }

    public function indexuser()
    {
        $bukus = Buku::latest()->get();
        return view('dashboard.buku', compact('bukus'));
    }

    public function show($id)
{
    $buku = Buku::findOrFail($id);
    return view('admin.pustaka.buku.show', compact('buku'));
}


  
}
