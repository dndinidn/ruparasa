<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Pesanan;
use App\Models\PesananItem;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    // ======================
    // USER SECTION
    // ======================

    // Tambah produk ke keranjang sementara (user)
    public function beli(Request $request, $produk_id)
    {
        $produk = Produk::findOrFail($produk_id);
        $jumlah = $request->jumlah ?? 1;

        // Buat pesanan sementara untuk user
        $pesanan = Pesanan::firstOrCreate(
            ['user_id' => Auth::id(), 'status' => 'menunggu'],
            ['total' => 0, 'ongkir' => 0]
        );

        // Tambah atau update item pesanan
        PesananItem::updateOrCreate(
            ['pesanan_id' => $pesanan->id, 'produk_id' => $produk_id],
            ['jumlah' => $jumlah, 'harga' => $produk->harga]
        );

        return redirect()->route('pesanan.index')->with('success', 'Produk ditambahkan ke pesanan');
    }

    // Halaman daftar pesanan (keranjang)
    public function index()
    {
        $pesanan = Pesanan::with('items.produk')
            ->where('user_id', Auth::id())
            ->where('status', 'menunggu')
            ->first();

        return view('dashboard.pesanan', compact('pesanan'));
    }

    // Update jumlah item (+ / -)
    public function updateItem(Request $request, $item_id)
    {
        $item = PesananItem::findOrFail($item_id);
        $item->jumlah = $request->jumlah;
        $item->save();

        return redirect()->back();
    }

    // Checkout pesanan
    public function checkout(Request $request)
    {
        $pesanan = Pesanan::with('items')
            ->where('user_id', Auth::id())
            ->where('status','menunggu')
            ->firstOrFail();

        $pesanan->metode_pembayaran = $request->metode_pembayaran;
        $pesanan->ongkir = 10000;
        $pesanan->total = $pesanan->items->sum(fn($i)=> $i->harga * $i->jumlah) + $pesanan->ongkir;

        // COD langsung dikemas, transfer menunggu konfirmasi admin
        $pesanan->status = $request->metode_pembayaran === 'cod' ? 'dikemas' : 'menunggu_konfirmasi';
        $pesanan->save();

        return redirect()->route('pesanan.pembayaran', $pesanan->id);
    }

    // Halaman pembayaran (BRIVA / COD)
    public function pembayaran($pesanan_id)
    {
        $pesanan = Pesanan::with('items.produk')->findOrFail($pesanan_id);
        return view('dashboard.pembayaran', compact('pesanan'));
    }

    // Konfirmasi pembayaran (BRIVA) -> hanya untuk user tekan selesai
    public function bayar(Request $request, $pesanan_id)
{
    $pesanan = Pesanan::findOrFail($pesanan_id);

    // langsung COD
    $pesanan->metode_pembayaran = 'cod';
    $pesanan->status = 'dikemas'; // langsung dikemas
    $pesanan->ongkir = 10000;
    $pesanan->total = $pesanan->items->sum(fn($i)=> $i->harga * $i->jumlah) + $pesanan->ongkir;
    $pesanan->save();

    // redirect ke halaman Status Pengiriman
    return redirect()->route('pesananuser.lihat')->with('success', 'Pesanan berhasil dibayar COD.');
}

    // Halaman lihat status pengiriman
// public function lihatPengiriman()
// {
//     $pesanan = Pesanan::with('items.produk')
//         ->where('user_id', Auth::id())
//         ->whereIn('status', ['dikemas','dikirim'])
//         ->get(); // harus pakai get(), bukan first()
    
//     return view('dashboard.lihatpengiriman', compact('pesanan'));
// }
public function lihatPengiriman()
{
    $pesanan = Pesanan::with('items.produk')
        ->where('user_id', Auth::id())
        ->whereIn('status', ['dikemas','dikirim','diterima']) // ambil semua status relevan
        ->get();

    return view('dashboard.lihatpengiriman', compact('pesanan'));
}


    

    // ======================
    // PENJUAL / ADMIN SECTION
    // ======================

    // Daftar semua pesanan (penjual)
    public function penjualPesanan()
    {
        // COD
        $pesananCod = Pesanan::with('items.produk','user')
            ->where('metode_pembayaran','cod')
            ->whereIn('status',['menunggu','dikemas'])
            ->get();

        // Transfer / BRIVA
        $pesananTransfer = Pesanan::with('items.produk','user')
            ->where('metode_pembayaran','transfer')
            ->where('status','menunggu_konfirmasi')
            ->get();

        return view('penjual.pesanan', compact('pesananCod','pesananTransfer'));
    }

    // Proses COD (penjual)
    public function penjualCod($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->status = 'dikemas'; // langsung update
        $pesanan->save();

        return redirect()->back()->with('success','Pesanan COD telah diproses.');
    }

    // Detail transfer / BRIVA (penjual)
    public function penjualTransferDetail($id)
    {
        $pesanan = Pesanan::with('items.produk','user')->findOrFail($id);
        return view('penjual.transfer-detail', compact('pesanan'));
    }

    // Konfirmasi transfer / BRIVA (penjual)
    public function penjualKonfirmasiTransfer(Request $request, $id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->status = 'dikemas';
        $pesanan->save();

        return redirect()->route('penjual.pesanan')->with('success','Transfer BRIVA dikonfirmasi.');
    }

    // Daftar pembayaran (penjual)
    public function penjualPembayaran()
    {
        $pembayaran = Pesanan::with('user','items.produk')
            ->whereIn('status',['dikemas','dikirim'])
            ->get();

        return view('penjual.pembayaran', compact('pembayaran'));
    }

    // Update status pengiriman (penjual)
    public function penjualUpdateStatus(Request $request, $pesanan_id)
    {
        $pesanan = Pesanan::findOrFail($pesanan_id);
        $pesanan->status = $request->status;
        $pesanan->save();

        return redirect()->back()->with('success','Status pengiriman diperbarui');
    }

    // Hapus pesanan (user)
public function destroy($id)
{
    $pesanan = Pesanan::findOrFail($id);
    $pesanan->delete();

    return redirect()->back()->with('success', 'Pesanan berhasil dihapus.');
}

// User terima pesanan
public function terimaPesanan($id)
{
    $pesanan = Pesanan::where('user_id', Auth::id())
        ->where('status', 'dikirim')
        ->findOrFail($id);

    $pesanan->status = 'diterima';
    $pesanan->save();

    return redirect()->route('pesananuser.lihat')->with('success', 'Pesanan telah diterima.');
}

public function lihat()
    {
        $pesanan = Pesanan::with('items.produk')
            ->where('user_id', Auth::id())
            ->whereIn('status', ['dikemas','dikirim','diterima'])
            ->get();

        return view('penjual.lihatpesanan', compact('pesanan'));
    }
    


}
