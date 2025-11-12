<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Toko;
use Illuminate\Http\Request;

class tokoController extends Controller
{
    //  public function construct(){
    //     $this->middleware('auth'); // semua method wajib login
    // }


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
