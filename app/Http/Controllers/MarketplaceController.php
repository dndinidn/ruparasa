<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Toko;
use Illuminate\Http\Request;

class MarketplaceController extends Controller
{

    public function index()
    {
        // Ambil semua data toko beserta relasi user (penjual)
        $toko = Toko::with('user')->get();

        return view('admin.marketplace', compact('toko'));
    }


}
