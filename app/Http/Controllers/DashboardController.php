<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Rupa;
use App\Models\Resep;
use App\Models\Agenda;
use App\Models\Video;
use App\Models\Artikel;
use App\Models\Buku;
use App\Models\Cerita;
use App\Models\Toko;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalUsers' => User::count(),
            'totalPenjual' => User::count(),
            'totalRupa' => Rupa::count(),
            'totalRasa' => Resep::count(),
            'totalAgenda' => Agenda::count(),
            'totalVideo' => Video::count(),
            'totalArtikel' => Artikel::count(),
            'totalBuku' => Buku::count(),
            'totalCerita' => Cerita::count(),
            'totalToko' => Toko::count(),
        ]);
    }
}
