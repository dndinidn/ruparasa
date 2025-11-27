<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // 🔹 Menampilkan daftar pengguna biasa
<<<<<<< HEAD
    public function userList(Request $request)
{
    // Ambil keyword pencarian
    $search = $request->input('search');

    // Query default (JANGAN DIUBAH)
    $query = User::where('role', 'user');

    // Jika ada pencarian, filter berdasarkan nama/email
    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('name', 'LIKE', "%$search%")
              ->orWhere('email', 'LIKE', "%$search%");
        });
    }

    // Ambil data user
    $users = $query->get();

    // Kirim ke view
    return view('admin.user', compact('users', 'search'));
}


    // 🔹 Menampilkan daftar penjual
    public function penjualList(Request $request)
{
    // Ambil keyword pencarian (jika ada)
    $search = $request->input('search');

    // Query default (JANGAN DIUBAH)
    $query = User::where('role', 'penjual');

    // Jika ada pencarian → filter by name atau email
    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('name', 'LIKE', "%$search%")
              ->orWhere('email', 'LIKE', "%$search%");
        });
    }

    // Ambil data penjual
    $penjuals = $query->get();

    return view('admin.penjual', compact('penjuals', 'search'));
}

=======
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
>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a
}
