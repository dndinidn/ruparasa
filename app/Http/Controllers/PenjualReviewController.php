<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class PenjualReviewController extends Controller
{
    public function index()
{
    $penjualId = auth()->user()->penjual->id ?? null;

    $reviews = Review::with('user','produk')
        ->whereHas('produk', function($q) use ($penjualId) {
            $q->where('penjual_id', $penjualId);
        })
        ->latest()
        ->get();

    return view('penjual.review', compact('reviews'));
}

 // Tampilkan form balasan
    public function balasForm($id)
    {
        $review = Review::with('produk', 'user')->findOrFail($id);
        return view('penjual.balasreview', compact('review'));
    }

    // Simpan balasan penjual
    public function balasSubmit(Request $request, $id)
    {
        $review = Review::findOrFail($id);

        $request->validate([
            'balasan_penjual' => 'required|string|max:500',
        ]);

        $review->update([
            'balasan_penjual' => $request->balasan_penjual
        ]);

        return redirect()->route('penjual.review.index')
                         ->with('success', 'Balasan berhasil dikirim!');
    }

}
