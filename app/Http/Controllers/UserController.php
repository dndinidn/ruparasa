<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // 🔹 Menampilkan daftar pengguna biasa
    public function userList()
    {
        $users = User::where('role', 'user')->get();
        return view('admin.user', compact('users'));
    }

    // 🔹 Menampilkan daftar penjual
    public function penjualList()
    {
        $penjuals = User::where('role', 'penjual')->get();
        return view('admin.penjual', compact('penjuals'));
    }
}
