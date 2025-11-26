<?php

namespace App\Http\Controllers;
use App\Models\Review;
use App\Models\Produk;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Produk $produk)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'nullable|string|max:500',
        ]);

        Review::create([
            'user_id' => auth()->id(),
            'produk_id' => $produk->id,
            'rating' => $request->rating,
            'komentar' => $request->komentar,
        ]);

        return redirect()->back()->with('success', 'Review berhasil ditambahkan!');
    }

    // Menampilkan form review
public function reviewForm($id)
{
    $pesanan = Pesanan::with(relations: 'items.produk')->findOrFail($id);

    // Pastikan status pesanan selesai
    if($pesanan->status !== 'selesai'){
        return redirect()->back()->with('error', 'Pesanan belum selesai, tidak bisa review.');
    }

    return view('dashboard.review', compact('pesanan'));
}

// Menyimpan review
public function submitReview(Request $request, $pesananId)
{
    $pesanan = Pesanan::with('items.produk')->findOrFail($pesananId);

    foreach ($request->produk_id as $index => $produkId) {
        Review::create([
            'user_id' => auth()->id(),
            'produk_id' => $produkId,
            'rating' => $request->rating[$index],
            'komentar' => $request->komentar[$index],
        ]);
    }

    return redirect()->route('produk.detail', $request->produk_id[0])
                     ->with('success', 'Review terkirim!');
}


}
