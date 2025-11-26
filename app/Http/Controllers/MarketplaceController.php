<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Toko;
use Illuminate\Http\Request;

class MarketplaceController extends Controller
{

    public function index(Request $request)
{
    $query = Toko::with('user');

    // 🔍 FITUR PENCARIAN
    if ($request->search) {
        $search = $request->search;

        $query->where('nama_toko', 'like', "%$search%")
              ->orWhereHas('user', function ($q) use ($search) {
                  $q->where('name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%");
              });
    }

    // Ambil data
    $toko = $query->get();

    return view('admin.marketplace', compact('toko'));
}



}
