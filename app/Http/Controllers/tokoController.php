<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Toko;
use Illuminate\Http\Request;
<<<<<<< HEAD
use Illuminate\Validation\Rule;

class tokoController extends Controller
{
    // public function __construct(){
=======

class tokoController extends Controller
{
    //  public function construct(){
>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a
    //     $this->middleware('auth'); // semua method wajib login
    // }


<<<<<<< HEAD
    /**
     * Tampilkan semua penjual (marketplace)
     * Route: /marketplace
     */
    public function index(Request $request)
    {
        // Ambil input pencarian
        $search = $request->input('search');

        // Ambil semua toko, filter jika ada pencarian
        $penjual = Toko::with('user')
            ->when($search, function($query, $search) {
                $query->where('nama_toko', 'like', "%{$search}%")
                    ->orWhere('alamat', 'like', "%{$search}%");
            })
            ->get();

        return view('dashboard.marketplace', compact('penjual'));
    }

    // ------------------------------------------------------------------

    /**
     * Helper untuk validasi jumlah produk yang ketat.
     * Memastikan input adalah bilangan bulat positif dan tidak melebihi stok.
     */
    protected function validateJumlah(Request $request, $produkId)
    {
        // 1. Temukan produk untuk validasi stok
        $produk = Produk::findOrFail($produkId);

        // 2. Validasi Ketat
        $validated = $request->validate([
            'jumlah' => [
                'required',
                'numeric',
                'min:1', 
                'integer', // HARUS bilangan bulat (tidak boleh desimal/koma)
                'max:' . $produk->stok // Tidak boleh melebihi stok yang tersedia
            ],
        ], [
            // Custom pesan kesalahan
            'jumlah.required' => 'Jumlah wajib diisi.',
            'jumlah.numeric' => 'Jumlah harus berupa angka.',
            'jumlah.min' => 'Jumlah minimal 1.',
            'jumlah.integer' => 'Jumlah harus bilangan bulat positif.',
            'jumlah.max' => 'Stok tidak mencukupi. Stok yang tersedia: ' . $produk->stok . '.',
        ]);

        return $validated['jumlah'];
    }

    // ------------------------------------------------------------------

    /**
     * Menambahkan produk ke keranjang
     * Route: pesanan.keranjang.tambah
     */
    public function keranjangTambah(Request $request, $produkId)
    {
        // Validasi jumlah
        $jumlah = $this->validateJumlah($request, $produkId);

        // --- MASUKKAN LOGIKA TAMBAH KE KERANJANG DI SINI ---
        // Contoh: $keranjang->addItem(auth()->id(), $produkId, $jumlah);
        
        // Redirect kembali dengan pesan sukses
        return back()->with('success', "Produk berhasil ditambahkan ke keranjang sebanyak $jumlah.");
    }

    /**
     * Melakukan pembelian langsung
     * Route: pesanan.beli
     */
    public function beli(Request $request, $produkId)
    {
        // Validasi jumlah
        $jumlah = $this->validateJumlah($request, $produkId);

        // --- MASUKKAN LOGIKA BUAT PESANAN LANGSUNG DI SINI ---
        
        // Asumsi 'pesananuser.lihat' adalah rute ke halaman checkout/ringkasan pesanan
        return redirect()->route('pesananuser.lihat');
    }

    // ------------------------------------------------------------------

    /**
     * Tampilkan produk berdasarkan penjual
     * Route: produk
     */
    public function produk(Request $request, $penjual_id)
    {
        $query = Produk::where('penjual_id', $penjual_id);

        // 🔍 Filter pencarian
        if ($request->cari) {
            $query->where('nama_produk', 'LIKE', '%' . $request->cari . '%');
        }

        // 🔍 Filter kategori
        if ($request->kategori) {
            $query->where('kategori', $request->kategori);
        }

        $produks = $query->get();

        return view('dashboard.produk', [
            'produks' => $produks,
            'penjual_id' => $penjual_id
        ]);
    }

    /**
     * Tampilkan detail produk
     * Route: produk.detail
     */
    public function detail($id)
    {
        $produk = Produk::with('reviews.user')->findOrFail($id);
        return view('dashboard.detailproduk', compact('produk'));
    }
}
=======
    // Tampilkan semua penjual (marketplace)
    public function index()
    {
        // Ambil semua toko beserta user penjualnya
        $penjual = Toko::with('user')->get();
        return view('dashboard.marketplace', compact('penjual'));
    }

    // Tampilkan produk berdasarkan penjual
    public function produk($penjual_id)
    {
        $produks = Produk::where('penjual_id', $penjual_id)->get(); // ❌ gunakan get() supaya dapat collection
        return view('dashboard.produk', compact('produks')); // kirim variabel $produks
    }

    // Tampilkan detail produk
    public function detail(Produk $produk)
    {
        return view('dashboard.detailproduk', compact('produk'));
    }
}
>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a
