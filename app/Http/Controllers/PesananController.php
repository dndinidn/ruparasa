<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Pesanan;
use App\Models\PesananItem;
use Illuminate\Support\Facades\DB;

use App\Models\Ongkir;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    // ======================
    // USER SECTION
    // ======================

    // Tambah produk ke "keranjang"
    // Beli Sekarang → hanya satu produk 
    public function beli(Request $request, $produk_id) { $produk = Produk::findOrFail($produk_id); 
        $jumlah = $request->jumlah ?? 1; 
        // Hapus semua pesanan aktif sebelumnya (status 'dikemas') 
        Pesanan::where('user_id', Auth::id()) 
            ->where('status', 'dikemas') 
            ->delete(); 
            
        // Buat pesanan baru 
        $pesanan = Pesanan::create([ 
            'user_id' => Auth::id(), 
            'status' => 'dikemas', 
            'total' => $produk->harga * $jumlah, 'ongkir' => 0, ]); 
        
        // Tambah item produk 
        PesananItem::create([ 
            'pesanan_id' => $pesanan->id, 
            'produk_id' => $produk->id, 
            'jumlah' => $jumlah, 
            'harga' => $produk->harga ]); 
            return redirect()->route('pesanan.index')->with('success', 'Produk berhasil dipesan.'); }

    // Halaman daftar pesanan (keranjang)
    // Halaman daftar pesanan (daftar pesanan)
public function index()
{
    $user = Auth::user(); // ambil data user

    $pesanan = Pesanan::with('items.produk.penjual')
        ->where('user_id', $user->id)
        ->where('status', 'dikemas')
        ->first();

    if ($pesanan) {
        // isi alamat dari profil user
        $pesanan->provinsi = $user->provinsi ?? $pesanan->provinsi;
        $pesanan->kota = $user->kota ?? $pesanan->kota;
        $pesanan->alamat = $user->alamat ?? $pesanan->alamat;

        // hitung ongkir otomatis dari profil user
        if ($pesanan->items->isNotEmpty()) {
            $produkPertama = $pesanan->items->first()->produk;
            $kotaToko = $produkPertama->penjual->kota ?? null;
            $kotaPembeli = $pesanan->kota ?? null;

            $ongkir = Ongkir::where('dari_kota', $kotaToko)
                        ->where('ke_kota', $kotaPembeli)
                        ->value('ongkir') ?? 0;

            $pesanan->ongkir = $ongkir;
            $pesanan->total = $pesanan->items->sum(fn($i)=> $i->harga * $i->jumlah) + $ongkir;
        }
    }

    return view('dashboard.pesanan', compact('pesanan', 'user'));
}


    // Update jumlah item
    public function updateItem(Request $request, $item_id)
    {
        $item = PesananItem::findOrFail($item_id);
        $item->jumlah = $request->jumlah;
        $item->save();

        return redirect()->back();
    }

    // Checkout / Bayar COD
public function checkout(Request $request)
{
    $request->validate([
        'provinsi' => 'required',
        'kota' => 'required',
        'alamat_lengkap' => 'required'
    ]);

    $pesanan = Pesanan::with('items.produk.penjual')
        ->where('user_id', Auth::id())
        ->where('status', 'dikemas')
        ->firstOrFail();

    $pesanan->provinsi = $request->provinsi;
    $pesanan->kota = $request->kota;
    $pesanan->alamat = $request->alamat_lengkap;

    // Hitung ongkir berdasarkan produk pertama
    $produkPertama = $pesanan->items->first()->produk;
    $kotaToko = $produkPertama->penjual->kota;
    $kotaPembeli = $pesanan->kota;

    $ongkir = Ongkir::where('dari_kota', $kotaToko)
                ->where('ke_kota', $kotaPembeli)
                ->value('ongkir') ?? 0;

    $pesanan->ongkir = $ongkir;
    $pesanan->total = $pesanan->items->sum(fn($i)=> $i->harga * $i->jumlah) + $ongkir;
    $pesanan->save();

    return redirect()->route('pesananuser.lihat')->with('success', 'Pesanan berhasil dibuat.');
}




    // Halaman pembayaran (hanya info COD)
    public function pembayaran($pesanan_id)
    {
        $pesanan = Pesanan::with('items.produk')->findOrFail($pesanan_id);
        return view('dashboard.pembayaran', compact('pesanan'));
    }

    // Konfirmasi pesanan (COD)
    // Checkout / Bayar COD otomatis dari profil
public function bayar(Request $request, $pesanan_id)
{
    $user = Auth::user();
    $pesanan = Pesanan::with('items.produk.penjual')
        ->where('user_id', $user->id)
        ->where('status', 'dikemas')
        ->findOrFail($pesanan_id);

    if ($pesanan->items->isEmpty()) {
        return back()->with('error', 'Pesanan tidak memiliki item.');
    }

    // alamat & kota otomatis dari profil
    $pesanan->provinsi = $user->provinsi;
    $pesanan->kota = $user->kota;
    $pesanan->alamat = $user->alamat;

    // ongkir otomatis
    $produkPertama = $pesanan->items->first()->produk;
    $kotaToko = $produkPertama->penjual->kota;
    $kotaPembeli = $pesanan->kota;

    $ongkir = Ongkir::where('dari_kota', $kotaToko)
                ->where('ke_kota', $kotaPembeli)
                ->value('ongkir') ?? 0;

    $pesanan->ongkir = $ongkir;
    $pesanan->total = $pesanan->items->sum(fn($i)=> $i->harga * $i->jumlah) + $ongkir;
    $pesanan->status = 'dikemas'; // tetap COD
    $pesanan->save();

    return redirect()->route('pesanan.pembayaran', $pesanan->id)
        ->with('success', 'Pesanan berhasil dibuat (COD).');
}



    // Lihat status pengiriman
    public function lihatPengiriman()
    {
        $pesanan = Pesanan::with('items.produk')
            ->where('user_id', Auth::id())
            ->whereIn('status', ['menunggu_konfirmasi', 'dikemas', 'dikirim', 'selesai'])
            ->get();

        return view('dashboard.lihatpengiriman', compact('pesanan'));
    }

    // Tandai pesanan diterima
    public function terimaPesanan($id)
    {
        $pesanan = Pesanan::where('user_id', Auth::id())
            ->where('status', 'dikirim')
            ->findOrFail($id);

        $pesanan->status = 'selesai';
        $pesanan->save();

        return back()->with('success', 'Terima kasih! Pesanan telah diterima.');
    }

    // ======================
    // PENJUAL SECTION
    // ======================

    // Lihat pesanan masuk
    public function penjualPesanan()
    {
        $pesanan = Pesanan::with(['items.produk','user'])
            ->whereHas('items.produk.penjual', fn($q) => $q->where('user_id', auth()->id()))
            ->whereIn('status', ['menunggu_konfirmasi','dikemas','dikirim'])
            ->orderByDesc('id')
            ->get();

        return view('penjual.pesanan', compact('pesanan'));
    }

    // Lihat pesanan selesai
    public function penjualPesananSelesai()
    {
        $pesanan = Pesanan::with(['items.produk','user'])
            ->whereHas('items.produk.penjual', fn($q) => $q->where('user_id', auth()->id()))
            ->where('status', 'selesai')
            ->orderBy('id', 'asc')
            ->get();

        return view('penjual.lihatpesanan', compact('pesanan'));
    }

    // Update status (penjual)
    public function penjualUpdateStatus(Request $request, $pesanan_id)
    {
        $request->validate(['status' => 'required|in:dikemas,dikirim,selesai']);

        $pesanan = Pesanan::findOrFail($pesanan_id);
        $pesanan->status = $request->status;
        $pesanan->save();

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui.');
    }

    // Hapus pesanan
    public function destroy($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->delete();

        return redirect()->back()->with('success', 'Pesanan berhasil dihapus.');
    }

    public function destroyItem($id)
{
    $item = PesananItem::findOrFail($id);
    $item->delete();

    return redirect()->back()->with('success', 'Item pesanan berhasil dihapus.');
}

// Tambah produk ke keranjang (status 'dikemas')
public function tambahKeranjang(Request $request, Produk $produk)
{
    $jumlah = $request->jumlah ?? 1;

    // Ambil atau buat pesanan aktif user
    $pesanan = Pesanan::firstOrCreate(
        ['user_id' => Auth::id(), 'status' => 'dikemas'],
        ['total' => 0, 'ongkir' => 0]
    );

    // Tambah atau update item
    PesananItem::updateOrCreate(
        ['pesanan_id' => $pesanan->id, 'produk_id' => $produk->id],
        ['jumlah' => DB::raw("jumlah + $jumlah"), 'harga' => $produk->harga]
    );

    // Update total pesanan
    $pesanan->total = $pesanan->items->sum(fn($i)=> $i->harga * $i->jumlah);
    $pesanan->save();

    return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');
}


// Lihat keranjang
public function lihatKeranjang()
{
    $pesanan = Pesanan::with('items.produk')
                ->where('user_id', Auth::id())
                ->where('status', 'dikemas')
                ->first();

    return view('dashboard.keranjang', compact('pesanan'));
}

// Checkout COD dari keranjang
public function bayarKeranjang(Request $request, Pesanan $pesanan)
{
    $request->validate([
        'kota' => 'required|string'
    ]);

    // Ambil ongkir dari tabel Ongkir
    $produkPertama = $pesanan->items->first()->produk;
    $kotaToko = $produkPertama->penjual->kota;
    $kotaPembeli = $request->kota;

    $ongkir = Ongkir::where('dari_kota', $kotaToko)
                ->where('ke_kota', $kotaPembeli)
                ->value('ongkir') ?? 0;

    $pesanan->ongkir = $ongkir;
    $pesanan->total = $pesanan->items->sum(fn($i) => $i->harga * $i->jumlah) + $ongkir;
    $pesanan->status = 'dikemas';
    $pesanan->save();

    return redirect()->route('pesananuser.lihat')->with('success', 'Pesanan berhasil dibuat (COD).');
}


}
