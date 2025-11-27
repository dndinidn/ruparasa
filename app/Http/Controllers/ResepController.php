<?php

namespace App\Http\Controllers;

use App\Models\Resep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResepController extends Controller
{
    // 🔹 Menampilkan semua data resep di admin
<<<<<<< HEAD
    public function index(Request $request)
{
    $reseps = Resep::when($request->search, function ($q) use ($request) {
        $q->where('nama_rasa', 'like', '%' . $request->search . '%');
    })
    ->latest()
    ->get();

    return view('admin.lihat-resep', compact('reseps'));
}

=======
    public function index()
    {
        $reseps = Resep::latest()->get();
        return view('admin.lihat-resep', compact('reseps'));
    }
>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a

    // 🔹 Tampilkan form tambah resep
    public function create()
    {
        return view('admin.tambah-resep');
    }

    // 🔹 Simpan data resep ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama_rasa' => 'required|string|max:255',
            'provinsi_asal' => 'required|string|max:255',
            'resep' => 'required|string',
            'sejarah' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Simpan gambar jika ada
        $path = $request->file('gambar')?->store('gambar_resep', 'public');

        // Simpan ke database
        Resep::create([
            'nama_rasa' => $request->nama_rasa,
            'provinsi_asal' => $request->provinsi_asal,
            'resep' => $request->resep,
            'sejarah' => $request->sejarah,
            'gambar' => $path,
        ]);

        return redirect()->route('resep.index')->with('success', 'Resep berhasil ditambahkan!');
    }

    // 🔹 Tampilkan form edit
    public function edit($id)
    {
        $resep = Resep::findOrFail($id);
        return view('admin.edit-resep', compact('resep'));
    }

    // 🔹 Proses update data resep
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_rasa' => 'required|string|max:255',
            'provinsi_asal' => 'required|string|max:255',
            'resep' => 'required|string',
            'sejarah' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $resep = Resep::findOrFail($id);

        // Ganti gambar jika ada file baru
        if ($request->hasFile('gambar')) {
            if ($resep->gambar && Storage::disk('public')->exists($resep->gambar)) {
                Storage::disk('public')->delete($resep->gambar);
            }
            $resep->gambar = $request->file('gambar')->store('gambar_resep', 'public');
        }

        $resep->update([
            'nama_rasa' => $request->nama_rasa,
            'provinsi_asal' => $request->provinsi_asal,
            'resep' => $request->resep,
            'sejarah' => $request->sejarah,
            'gambar' => $resep->gambar,
        ]);

        return redirect()->route('resep.index')->with('success', 'Resep berhasil diperbarui!');
    }

    // 🔹 Hapus data resep
    public function destroy($id)
    {
        $resep = Resep::findOrFail($id);

        if ($resep->gambar && Storage::disk('public')->exists($resep->gambar)) {
            Storage::disk('public')->delete($resep->gambar);
        }

        $resep->delete();

        return redirect()->route('resep.index')->with('success', 'Resep berhasil dihapus!');
    }

    // 🔹 Detail resep di frontend
    public function showFrontend($id)
    {
        $resep = Resep::findOrFail($id);
        return view('dashboard.detail-resep', compact('resep'));
    }

    // 🔹 Semua resep di halaman "Lihat Semua"
    public function indexFrontend()
    {
        $reseps = Resep::latest()->paginate(10);
        return view('dashboard.semua-resep', compact('reseps'));
    }

    // 🔹 Halaman rasa (daftar resep + form tambah)
    public function rasaIndex()
    {
        $reseps = Resep::latest()->paginate(10);
        return view('dashboard.rasa', compact('reseps'));
    }

    // 🔹 Simpan resep baru dari frontend
    public function rasaStore(Request $request)
    {
        $request->validate([
            'nama_rasa' => 'required|string|max:255',
            'provinsi_asal' => 'required|string|max:255',
            'resep' => 'required|string',
            'sejarah' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $path = $request->file('gambar')?->store('gambar_resep', 'public');

        Resep::create([
            'nama_rasa' => $request->nama_rasa,
            'provinsi_asal' => $request->provinsi_asal,
            'resep' => $request->resep,
            'sejarah' => $request->sejarah,
            'gambar' => $path,
        ]);

        return redirect()->route('rasa.index')->with('success', 'Resep berhasil ditambahkan!');
    }

    public function detail($id)
{
    $resep = Resep::findOrFail($id);
    return view('admin.detailResep', compact('resep'));
}

}
