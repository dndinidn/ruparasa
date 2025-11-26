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
  public function beli(Request $request, $produk_id)
{
    $produk = Produk::findOrFail($produk_id);
    $jumlah = $request->jumlah ?? 1;

    // Simpan data beli sekarang ke session (bukan ke database)
    session([
        'beli_sekarang' => [
            'produk_id' => $produk->id,
            'nama'      => $produk->nama_produk,
            'harga'     => $produk->harga,
            'jumlah'    => $jumlah,
            'total'     => $produk->harga * $jumlah
        ]
    ]);

    return redirect()->route('pesanan.index');
}

    // Halaman daftar pesanan (keranjang)
    // Halaman daftar pesanan (daftar pesanan)
public function index()
{
    $user = Auth::user();

    // Jika beli sekarang → ambil dari session
    if (session()->has('beli_sekarang')) {

        $data = session('beli_sekarang');

        // Format palsu seperti pesanan
        $pesanan = (object)[
            'id' => null,
            'items' => collect([
                (object)[
                    'produk' => Produk::find($data['produk_id']),
                    'jumlah' => $data['jumlah'],
                    'harga'  => $data['harga']
                ]
            ]),
            'provinsi' => $user->provinsi,
            'kota'     => $user->kota,
            'alamat'   => $user->alamat,
            'ongkir'   => 0,
            'total'    => $data['total']
        ];

        return view('dashboard.pesanan', compact('pesanan', 'user'));
    }

    // (kode anda untuk keranjang tetap di sini)
}


    // Update jumlah item
    public function updateItem(Request $request, $item_id)
{
    $item = PesananItem::findOrFail($item_id);
    $item->jumlah = $request->jumlah;
    $item->save();

    return response()->json(['success'=>true]);
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

public function bayar(Request $request, $id = null)
{
    $user = Auth::user();

    // ================================
    // 1) BAYAR DARI BELI SEKARANG
    // ================================
    if ($id === null) {
        if (!session()->has('beli_sekarang')) {
            return response()->json(['success' => false, 'message' => 'Session kosong']);
        }

        $data = session('beli_sekarang');

         // Cek stok produk
        $produk = Produk::find($data['produk_id']);
        if (!$produk || $produk->stok < $data['jumlah']) {
            return response()->json([
                'success' => false,
                'message' => "Stok produk '{$produk->nama_produk}' tidak mencukupi atau habis."
            ]);
        }

        

        // Buat pesanan baru
        $pesanan = Pesanan::create([
            'user_id'  => $user->id,
            'status'   => 'dikemas',
            'provinsi' => $user->provinsi,
            'kota'     => $user->kota,
            'alamat'   => $user->alamat,
            'ongkir'   => 0,
            'total'    => $data['total'],
        ]);

        // Tambahkan item
        PesananItem::create([
            'pesanan_id' => $pesanan->id,
            'produk_id'  => $data['produk_id'],
            'jumlah'     => $data['jumlah'],
            'harga'      => $data['harga'],
        ]);

        // **Kurangi stok produk**
    $produk->stok = $produk->stok - $data['jumlah'];
    $produk->save();

        // Hapus session
        session()->forget('beli_sekarang');

        return response()->json([
            'success' => true,
            'pesanan_id' => $pesanan->id
        ]);
    }

   // ================================
    // 2) BAYAR DARI KERANJANG (PERBAIKAN)
    // ================================
    $keranjang = Pesanan::with('items.produk.penjual')
        ->where('id', $id)
        ->where('user_id', $user->id)
        ->firstOrFail();

    if ($keranjang->items->isEmpty()) {
        return response()->json(['success' => false, 'message' => 'Keranjang kosong']);
    }

    // Cek stok setiap item
    foreach ($keranjang->items as $item) {
        if ($item->produk->stok < $item->jumlah) {
            return response()->json([
                'success' => false,
                'message' => "Stok produk '{$item->produk->nama_produk}' tidak mencukupi atau habis."
            ]);
        }
    }

    // Buat pesanan baru
    $pesananBaru = Pesanan::create([
        'user_id'  => $user->id,
        'status'   => 'dikemas',
        'provinsi' => $user->provinsi,
        'kota'     => $user->kota,
        'alamat'   => $user->alamat,
        'ongkir'   => 0,
        'total'    => 0,
    ]);

    // Salin semua item dari keranjang ke pesanan baru
    foreach ($keranjang->items as $item) {
        PesananItem::create([
            'pesanan_id' => $pesananBaru->id,
            'produk_id'  => $item->produk_id,
            'jumlah'     => $item->jumlah,
            'harga'      => $item->harga,
        ]);

         // **Kurangi stok produk**
    $produk = $item->produk;
    $produk->stok = $produk->stok - $item->jumlah;
    $produk->save();
}
    

    // Hitung ongkir dari produk pertama
    $produkPertama = $pesananBaru->items->first()->produk;
    $kotaToko = $produkPertama->penjual->kota;
    $kotaPembeli = $user->kota;

    $ongkir = Ongkir::where('dari_kota', $kotaToko)
        ->where('ke_kota', $kotaPembeli)
        ->value('ongkir') ?? 0;

    $pesananBaru->ongkir = $ongkir;
    $pesananBaru->total = $pesananBaru->items->sum(fn($i)=> $i->harga * $i->jumlah) + $ongkir;
    $pesananBaru->save();


    return response()->json([
        'success' => true,
        'pesanan_id' => $pesananBaru->id
    ]);
}


    // Halaman pembayaran (hanya info COD)
    public function pembayaran($pesanan_id)
    {
        $pesanan = Pesanan::with('items.produk')->findOrFail($pesanan_id);
        return view('dashboard.lihatpengiriman', compact('pesanan'));
    }

    // Konfirmasi pesanan (COD)
    // Checkout / Bayar COD otomatis dari profil
// public function bayar(Request $request, $pesanan_id)
// {
//     $user = Auth::user();
//     $pesanan = Pesanan::with('items.produk.penjual')
//         ->where('user_id', $user->id)
//         ->where('status', 'dikemas')
//         ->findOrFail($pesanan_id);

//     if ($pesanan->items->isEmpty()) {
//         return back()->with('error', 'Pesanan tidak memiliki item.');
//     }

//     // alamat & kota otomatis dari profil
//     $pesanan->provinsi = $user->provinsi;
//     $pesanan->kota = $user->kota;
//     $pesanan->alamat = $user->alamat;

//     // ongkir otomatis
//     $produkPertama = $pesanan->items->first()->produk;
//     $kotaToko = $produkPertama->penjual->kota;
//     $kotaPembeli = $pesanan->kota;

//     $ongkir = Ongkir::where('dari_kota', $kotaToko)
//                 ->where('ke_kota', $kotaPembeli)
//                 ->value('ongkir') ?? 0;

//     $pesanan->ongkir = $ongkir;
//     $pesanan->total = $pesanan->items->sum(fn($i)=> $i->harga * $i->jumlah) + $ongkir;
//     $pesanan->status = 'dikemas'; // tetap COD
//     $pesanan->save();

//     return redirect()->route('pesanan.pembayaran', $pesanan->id)
//         ->with('success', 'Pesanan berhasil dibuat (COD).');
// }
public function beliSekarang(Request $request)
{
    $user = auth()->user();
    $checkoutIds = $request->input('checkout', []); // array item yang dicentang

    if (empty($checkoutIds)) {
        return back()->with('error', 'Pilih minimal 1 item.');
    }

    // Ambil pesanan user dengan status 'dikemas'
    $pesanan = Pesanan::with('items.produk')
                ->where('user_id', $user->id)
                ->where('status', 'dikemas')
                ->first();

    if (!$pesanan) {
        return back()->with('error', 'Keranjang kosong.');
    }

    // Filter items sesuai checkbox
    $pesanan->items = $pesanan->items->whereIn('id', $checkoutIds);

    if ($pesanan->items->isEmpty()) {
        return back()->with('error', 'Item yang dipilih tidak ada.');
    }

    // Hitung subtotal
    $subtotal = $pesanan->items->sum(fn($i) => $i->harga * $i->jumlah);

    // Ongkir fix 15k (bisa diganti sesuai kebutuhan)
    $ongkir = 15000;

    // Total
    $total = $subtotal + $ongkir;

    // Ambil alamat user
    $alamat = $user->alamat;
    $kota   = $user->kota;
    $provinsi = $user->provinsi;

    return view('dashboard.konfirmasi', compact(
        'pesanan', 'subtotal', 'ongkir', 'total', 'alamat', 'kota', 'provinsi'
    ));
}









    // Lihat status pengiriman
    // public function lihatPengiriman()
    // {
    //     $pesanan = Pesanan::with('items.produk')
    //         ->where('user_id', Auth::id())
    //         ->whereIn('status', ['menunggu_konfirmasi', 'dikemas', 'dikirim', 'selesai'])
    //         ->get();

    //     return view('dashboard.lihatpengiriman', compact('pesanan'));
    // }

    public function lihatPengiriman()
    {
        $pesanan = Pesanan::where('user_id', Auth::id())
        ->whereIn('status', ['dikemas', 'dikirim', 'selesai'])
        ->with('items.produk')
        ->orderBy('created_at', 'DESC')
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
    public function penjualPesanan(Request $request)
{
    // Ambil kata kunci pencarian
    $cari = $request->cari;

    $pesanan = Pesanan::with(['items.produk','user'])
        ->whereHas('items.produk.penjual', fn($q) => 
            $q->where('user_id', auth()->id())
        )
        ->whereIn('status', ['menunggu_konfirmasi','dikemas','dikirim'])

        // ====== TAMBAHKAN FITUR PENCARIAN ======
        ->when($cari, function ($query) use ($cari) {
            $query->where(function($q) use ($cari) {

                // Cari berdasarkan nama user
                $q->whereHas('user', function($u) use ($cari) {
                    $u->where('name', 'LIKE', "%{$cari}%");
                })

                // Cari berdasarkan nama produk
                ->orWhereHas('items.produk', function($p) use ($cari) {
                    $p->where('nama_produk', 'LIKE', "%{$cari}%");
                })

                // Cari berdasarkan status
                ->orWhere('status', 'LIKE', "%{$cari}%");

            });
        })
        // ========================================

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
// public function bayarKeranjang(Request $request, Pesanan $pesanan)
// {
//     $request->validate([
//         'kota' => 'required|string'
//     ]);

//     // Ambil ongkir dari tabel Ongkir
//     $produkPertama = $pesanan->items->first()->produk;
//     $kotaToko = $produkPertama->penjual->kota;
//     $kotaPembeli = $request->kota;

//     $ongkir = Ongkir::where('dari_kota', $kotaToko)
//                 ->where('ke_kota', $kotaPembeli)
//                 ->value('ongkir') ?? 0;

//     $pesanan->ongkir = $ongkir;
//     $pesanan->total = $pesanan->items->sum(fn($i) => $i->harga * $i->jumlah) + $ongkir;
//     $pesanan->status = 'dikemas';
//     $pesanan->save();

//     return redirect()->route('pesananuser.lihat')->with('success', 'Pesanan berhasil dibuat (COD).');
// }
public function bayarKeranjang(Request $request, Pesanan $keranjang)
{
    $user = Auth::user();

    // 1. Buat pesanan baru dari keranjang
    $pesananBaru = Pesanan::create([
        'user_id' => $user->id,
        'status'  => 'dikemas',
        'provinsi'=> $user->provinsi,
        'kota'    => $user->kota,
        'alamat'  => $user->alamat,
    ]);

    // 2. Salin semua item dari keranjang
    foreach($keranjang->items as $item){
        PesananItem::create([
            'pesanan_id' => $pesananBaru->id,
            'produk_id'  => $item->produk_id,
            'jumlah'     => $item->jumlah,
            'harga'      => $item->harga
        ]);
    }

    // 3. Hitung total + ongkir
    $produkPertama = $pesananBaru->items->first()->produk;
    $kotaToko = $produkPertama->penjual->kota;
    $kotaPembeli = $user->kota;

    $ongkir = Ongkir::where('dari_kota', $kotaToko)
                    ->where('ke_kota', $kotaPembeli)
                    ->value('ongkir') ?? 0;

    $pesananBaru->ongkir = $ongkir;
    $pesananBaru->total = $pesananBaru->items->sum(fn($i)=> $i->harga * $i->jumlah) + $ongkir;
    $pesananBaru->save();

    // 4. Hapus keranjang lama
    $keranjang->items()->delete();
    $keranjang->delete();

    return redirect()->route('pesananuser.lihat')->with('success', 'Pesanan berhasil dibuat!');
}

//     public function lihat()
// {
//     $pesanan = Pesanan::with(['items.produk'])
//         ->whereHas('items.produk.penjual', function ($q) {
//             $q->where('user_id', auth()->id());
//         })
//         ->whereIn('status', ['dikemas','dikirim','selesai'])
//         ->orderByDesc('id')
//         ->get();

//     return view('penjual.lihatpesanan', compact('pesanan'));
// }

public function lihat(Request $request)
{
    // Ambil kata kunci pencarian
    $cari = $request->cari;

    $pesanan = Pesanan::with(['items.produk'])
        ->whereHas('items.produk.penjual', function ($q) {
            $q->where('user_id', auth()->id());
        })
        ->whereIn('status', ['dikemas','dikirim','selesai'])
        
        // ==== FITUR PENCARIAN ====
        ->when($cari, function ($query) use ($cari) {
            $query->where(function ($q) use ($cari) {

                // Cari berdasarkan ID pesanan
                $q->where('id', 'LIKE', "%{$cari}%")

                // Cari berdasarkan status
                  ->orWhere('status', 'LIKE', "%{$cari}%")

                // Cari berdasarkan nama produk
                  ->orWhereHas('items.produk', function($p) use ($cari){
                        $p->where('nama_produk', 'LIKE', "%{$cari}%");
                  });
            });
        })
        // ==========================
        
        ->orderByDesc('id')
        ->get();

    return view('penjual.lihatpesanan', compact('pesanan'));
}

public function konfirmasi()
{
    return view('dashboard.konfirmasi');
}

}
