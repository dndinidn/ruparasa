<?php

namespace App\Http\Controllers;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Pesanan;
use Illuminate\Support\Facades\Schema;

use Illuminate\Http\Request;

class penjualController extends Controller
{
public function index()
    {
        // Total produk
        $totalProduk = Produk::count();

        // Total pesanan
        $totalPesanan = Pesanan::count();

    

        // Cek nama kolom total
        if (Schema::hasColumn('pesanans', 'total_harga')) {
            $kolomTotal = 'total_harga';
        } elseif (Schema::hasColumn('pesanans', 'total')) {
            $kolomTotal = 'total';
        } else {
            $kolomTotal = null;
        }

        // Hitung total pendapatan (jika kolom ada)
        $totalPendapatan = $kolomTotal
            ? Pesanan::where('status', 'selesai')->sum($kolomTotal)
            : 0;

        // Ambil data terbaru
        $produk = Produk::latest()->take(5)->get();
        $pesanan = Pesanan::latest()->take(5)->get();
        

        return view('penjual.dashboard', compact(
            'totalProduk',
            'totalPesanan',
        ));
    }

    public function Penjual(){
        return view('penjual.dashboard');
    }
}
