<?php

namespace App\Http\Controllers;
use App\Models\Rupa;
use Illuminate\Http\Request;
use App\Models\Resep;
class Dashboard extends Controller
{
    public function index(){
        $reseps = Resep::latest()->take(5)->get();

        // Kirim data ke view
        return view('dashboard.index', compact('reseps'));

    }

    public function lihatRupaUser()
{
    $rupa = Rupa::all(); // ambil semua data
    return view('dashboard.rupa', compact('rupa'));
}

}
