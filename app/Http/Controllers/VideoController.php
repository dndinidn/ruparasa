<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    // Tampilkan semua video
    public function index(Request $request)
{
    $query = Video::latest();

    if ($request->has('search') && $request->search != '') {
        $keyword = $request->search;
        $query->where('judul', 'like', "%{$keyword}%");
    }

    $videos = $query->get();

    return view('admin.pustaka.video.index', compact('videos'));
}


    // Form tambah video
    public function create()
    {
        return view('admin.pustaka.video.tambah');
    }

    // Simpan video baru
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'video' => 'required|file|mimes:mp4,mov,avi|max:102400',
        ]);

        $path = $request->file('video')->store('videos', 'public');

        Video::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'video' => $path,
        ]);

        return redirect()->route('admin.video.index')->with('success', 'Video berhasil ditambahkan!');
    }

    // Form edit
    public function edit($id)
    {
        $video = Video::findOrFail($id);
        return view('admin.pustaka.video.edit', compact('video'));
    }

    // Update video
    public function update(Request $request, $id)
    {
        $video = Video::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'video' => 'nullable|file|mimes:mp4,mov,avi|max:102400',
        ]);

        $data = [
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
        ];

        if ($request->hasFile('video')) {
            // Hapus video lama jika ada
            if ($video->video && Storage::disk('public')->exists($video->video)) {
                Storage::disk('public')->delete($video->video);
            }
            $data['video'] = $request->file('video')->store('videos', 'public');
        }

        $video->update($data);

        return redirect()->route('admin.video.index')->with('success', 'Video berhasil diperbarui!');
    }

    // Hapus video
    public function destroy(Video $video)
    {
        if ($video->video && Storage::disk('public')->exists($video->video)) {
            Storage::disk('public')->delete($video->video);
        }
        $video->delete();

        return redirect()->route('admin.video.index')->with('success', 'Video berhasil dihapus!');
    }

    public function indexuser()
    {
        $videos = Video::latest()->get();
        return view('dashboard.video', compact('videos'));
    }

    public function show($id)
{
    $video = Video::findOrFail($id);
    return view('admin.pustaka.video.show', compact('video'));
}


    

}
