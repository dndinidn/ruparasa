<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Rupa;
use App\Models\Resep;
use App\Models\Agenda;
use App\Models\Video;
use App\Models\Artikel;
use App\Models\Buku;
use App\Models\Cerita;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function show(){
        return view('admin.dashboard');
    }

    public function index()
    {
        // Hitung data untuk dashboard
        $totalUsers = User::where('role', 'user')->count();
        $totalPenjual = User::where('role', 'penjual')->count();
        $totalRupa = Rupa::count();
        $totalRasa = Resep::count();
        $totalAgenda = Agenda::count();
        $totalVideo = Video::count();
        $totalArtikel = Artikel::count();
        $totalBuku = Buku::count();
        $totalCerita = Cerita::where('status', 'diterima')->count(); // Hanya cerita diterima

        // Kirim data ke view
        return view('admin.dashboard', compact(
            'totalUsers',
            'totalPenjual',
            'totalRupa',
            'totalRasa',
            'totalAgenda',
            'totalVideo',
            'totalArtikel',
            'totalBuku',
            'totalCerita'
        ));
    }
}

