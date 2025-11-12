<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    /**
     * Halaman publik menampilkan semua agenda (asc) → user biasa
     */
    public function index()
    {
        $agendaBudaya = Agenda::orderBy('tanggal', 'asc')->get();
        return view('agenda.budaya', compact('agendaBudaya'));
    }

    /**
     * Halaman admin: list dengan pagination (desc)
     */
    public function adminIndex()
    {
        $agendaBudaya = Agenda::orderBy('tanggal', 'desc')->paginate(10);
        return view('admin.agenda.index', compact('agendaBudaya'));
    }

    /**
     * Form tambah (admin)
     */
    public function create()
    {
        return view('admin.agenda.create');
    }

    /**
     * Simpan data baru (admin)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal'  => 'required|date',
            'nama'     => 'required|string|max:255',
            'lokasi'   => 'required|string|max:255',
            'deskripsi'=> 'required|string|max:1000',
        ]);

        Agenda::create($validated);

        return redirect()->route('admin.agenda.index')->with('success', 'Agenda berhasil ditambahkan (admin).');
    }

    /**
     * Simpan data baru (user biasa)
     */
    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'tanggal'  => 'required|date',
            'nama'     => 'required|string|max:255',
            'lokasi'   => 'required|string|max:255',
            'deskripsi'=> 'required|string|max:1000',
        ]);

        Agenda::create($validated);

        return redirect()->route('agenda.budaya')->with('success', 'Agenda berhasil ditambahkan!');
    }

    /**
     * Form edit (admin)
     */
    public function edit($id)
    {
        $agenda = Agenda::findOrFail($id);
        return view('admin.agenda.edit', compact('agenda'));
    }

    /**
     * Update data (admin)
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'tanggal'  => 'required|date',
            'nama'     => 'required|string|max:255',
            'lokasi'   => 'required|string|max:255',
            'deskripsi'=> 'required|string|max:1000',
        ]);

        $agenda = Agenda::findOrFail($id);
        $agenda->update($validated);

        return redirect()->route('admin.agenda.index')->with('success', 'Agenda berhasil diperbarui.');
    }

    /**
     * Hapus data (admin)
     */
    public function destroy($id)
    {
        $agenda = Agenda::findOrFail($id);
        $agenda->delete();

        return redirect()->route('admin.agenda.index')->with('success', 'Agenda berhasil dihapus.');
    }

    public function show($id)
{
    $agenda = Agenda::findOrFail($id);
    return view('admin.agenda.detailAgenda', compact('agenda'));
}

}
