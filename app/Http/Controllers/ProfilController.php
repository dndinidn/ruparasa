<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\ActivityLog;

class ProfilController extends Controller
{
    // 🟠 Menampilkan halaman profil user
    public function index()
    {
        $user = Auth::user();
        return view('dashboard.profil', compact('user'));
    }

    // 🟠 Menampilkan halaman edit profil
    public function edit()
    {
        $user = Auth::user();
        return view('dashboard.edit-profil', compact('user'));
    }

    // 🟠 Proses update data profil
    public function update(Request $request)
    {
        $user = Auth::user();

        // ✅ Validasi input termasuk alamat
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255|unique:users,email,' . $user->id,
            'bio'     => 'nullable|string|max:500',
            'provinsi' => 'nullable|string|max:100',
        'kota' => 'nullable|string|max:100',
            'alamat'  => 'nullable|string|max:255',   // ← DITAMBAH
            'photo'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'kontak' => 'nullable|string|max:20',
        ]);

        // ✅ Upload foto baru
        if ($request->hasFile('photo')) {
            if ($user->photo && Storage::exists('public/profile/' . $user->photo)) {
                Storage::delete('public/profile/' . $user->photo);
            }

            $filename = time() . '.' . $request->file('photo')->getClientOriginalExtension();
            $request->file('photo')->storeAs('public/profile', $filename);
            $validated['photo'] = $filename;
        }

        // ✅ Update data user (termasuk alamat)
        $user->update($validated);

        // Catat log aktivitas
        if (class_exists(ActivityLog::class)) {
            ActivityLog::create([
                'user_id' => $user->id,
                'activity' => 'Memperbarui profil pengguna',
                'ip_address' => $request->ip(),
            ]);
        }

        return redirect()->route('profil')->with('success', 'Profil berhasil diperbarui!');
    }

    // 🟠 Proses ubah password
    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama salah.']);
        }

        if (Hash::check($request->new_password, $user->password)) {
            return back()->withErrors(['new_password' => 'Password baru tidak boleh sama dengan password lama.']);
        }

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        if (class_exists(ActivityLog::class)) {
            ActivityLog::create([
                'user_id' => $user->id,
                'activity' => 'Mengubah password akun',
                'ip_address' => $request->ip(),
            ]);
        }

        try {
            Mail::raw(
                'Halo ' . $user->name . ",\n\nPassword akun Anda baru saja diubah.",
                function ($message) use ($user) {
                    $message->to($user->email)
                            ->subject('Notifikasi Perubahan Password');
                }
            );
        } catch (\Exception $e) {}

        return back()->with('success', 'Password berhasil diperbarui!');
    }
}
