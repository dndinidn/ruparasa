<?php

namespace App\Http\Controllers;

use App\Models\Rupa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class RupaController extends Controller
{
    /**
     * Menampilkan semua data rupa di halaman admin.
     */
<<<<<<< HEAD
    public function lihatRupa(Request $request)
{
    $search = $request->input('search');

    // Query awal (TIDAK DIUBAH)
    $query = Rupa::query();

    // Jika ada pencarian
    if ($search) {
        $query->where('judul', 'LIKE', "%$search%");
    }

    $rupa = $query->get();

    return view('admin.lihatRupa', compact('rupa', 'search'));
}


=======
    public function LihatRupa()
    {
        $rupa = Rupa::all();
        return view('admin.lihatRupa', compact('rupa'));
    }

>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a
    /**
     * Menampilkan form tambah data rupa.
     */
    public function TambahRupa()
    {
        return view('admin.tambahDataRupa');
    }

    /**
     * Simpan data rupa baru ke database.
     */
    public function simpanRupa(Request $request)
    {
        // Buat validasi manual agar bisa menampilkan pesan khusus
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'tipe' => 'required|string',
            'file_path' => 'required|file|mimes:jpg,jpeg,png,mp4,mov,avi|max:102400',
            'deskripsi' => 'required|string',
        ], [
            'judul.required' => 'Judul tidak boleh kosong.',
            'judul.max' => 'Judul maksimal 255 karakter.',
            'tipe.required' => 'Tipe harus dipilih.',
            'file_path.required' => 'File wajib diunggah.',
            'file_path.mimes' => 'Format file harus berupa JPG, JPEG, PNG, MP4, MOV, atau AVI.',
            'file_path.max' => 'Ukuran file maksimal 100 MB.',
            'deskripsi.required' => 'Deskripsi tidak boleh kosong.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator) // Kirim pesan error ke view
                ->withInput(); // Kembalikan input sebelumnya
        }

        // Simpan file ke folder storage/app/public/rupa
        $path = $request->file('file_path')->store('rupa', 'public');

        // Simpan data ke tabel 'rupas'
        Rupa::create([
            'judul' => $request->judul,
            'tipe' => $request->tipe,
            'file_path' => $path,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('dashboard.lihatrupa')
            ->with('success', '✅ Data Rupa berhasil ditambahkan!');
    }

    /**
     * Hapus data rupa beserta file dari storage.
     */
    public function hapusRupa($id)
    {
        $rupa = Rupa::find($id);
        if (!$rupa) {
            return redirect()->back()->with('error', '❌ Data rupa tidak ditemukan.');
        }

        if ($rupa->file_path && Storage::disk('public')->exists($rupa->file_path)) {
            Storage::disk('public')->delete($rupa->file_path);
        }

        $rupa->delete();

        return redirect()->back()->with('success', '✅ Data rupa berhasil dihapus.');
    }

    /**
     * Menampilkan form edit data rupa.
     */
    public function edit($id)
    {
        $rupa = Rupa::findOrFail($id);
        return view('admin.editRupa', compact('rupa'));
    }

    /**
     * Update data rupa.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'tipe' => 'required|string',
            'deskripsi' => 'required|string',
            'file_path' => 'nullable|file|mimes:jpg,jpeg,png,mp4,mov,avi|max:102400',
        ], [
            'judul.required' => 'Judul tidak boleh kosong.',
            'judul.max' => 'Judul maksimal 255 karakter.',
            'tipe.required' => 'Tipe wajib diisi.',
            'deskripsi.required' => 'Deskripsi tidak boleh kosong.',
            'file_path.mimes' => 'Format file harus JPG, JPEG, PNG, MP4, MOV, atau AVI.',
            'file_path.max' => 'Ukuran file maksimal 100 MB.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $rupa = Rupa::findOrFail($id);
        $path = $rupa->file_path;

        if ($request->hasFile('file_path')) {
            if ($rupa->file_path && Storage::disk('public')->exists($rupa->file_path)) {
                Storage::disk('public')->delete($rupa->file_path);
            }

            $path = $request->file('file_path')->store('rupa', 'public');
        }

        $rupa->update([
            'judul' => $request->judul,
            'tipe' => $request->tipe,
            'file_path' => $path,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('dashboard.lihatrupa')
            ->with('success', '✅ Data Rupa berhasil diperbarui!');
    }

    public function detail($id)
{
    $rupa = Rupa::findOrFail($id);
    return view('admin.detailRupa', compact('rupa'));
}

}
