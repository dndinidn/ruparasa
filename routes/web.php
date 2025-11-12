<?php

use App\Http\Controllers\ProfilController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ResepController;
use App\Http\Controllers\RupaController;
use App\Http\Controllers\tokoController;
use App\Http\Controllers\penjualController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\pustakaController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\CeritaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\MarketplaceController;
use App\Http\Controllers\PenjualProfileController;



// =====================================================
// 🏠 HALAMAN UTAMA & DASHBOARD
// =====================================================
Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [Dashboard::class, 'index']);
Route::get('/petaa', [Dashboard::class, 'peta']);
Route::get('/dashboard-admin', [AdminController::class, 'index'])->name('dashboard.index');

Route::middleware('auth')->group(function () {
    Route::get('/penjual/profil', [PenjualProfileController::class, 'edit'])->name('penjual.editprofil');
    Route::put('/penjual/profil', [PenjualProfileController::class, 'update'])->name('penjual.profile.update');
});

// =====================================================
// 🗺️ HALAMAN PETA & INFORMASI PROVINSI
// =====================================================
Route::get('/sulawesi-map', function () {
    return view('home');
})->name('map.sulawesi');

Route::get('/informasi/{provinsi}', function ($provinsi) {
    return view("informasi.$provinsi");
});

// =====================================================
// 👤 AUTENTIKASI (REGISTER, LOGIN, LOGOUT)
// =====================================================

// ✅ Register User
Route::get('/register-user', [AuthController::class, 'showRegisterForm'])->name('register-user');
Route::post('/register-user', [AuthController::class, 'register'])->name('register-user.store');

// ✅ Register Penjual
Route::get('/registerpenjual', [AuthController::class, 'registerPenjual'])->name('registerpenjual');
Route::post('/registerpenjual', [AuthController::class, 'submitRegistrasiPenjual'])->name('registerpenjual.store');

// ✅ Login & Logout
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// =====================================================
// 🍲 RESEP (ADMIN & FRONTEND)
// =====================================================
Route::prefix('admin')->group(function () {
    // Admin: Manajemen Resep
    Route::get('/resep', [ResepController::class, 'index'])->name('resep.index');
    Route::get('/resep/create', [ResepController::class, 'create'])->name('resep.create');
    Route::post('/resep/store', [ResepController::class, 'store'])->name('resep.store');
    Route::get('/resep/{id}/edit', [ResepController::class, 'edit'])->name('resep.edit');
    Route::put('/resep/{id}', [ResepController::class, 'update'])->name('resep.update');
    Route::delete('/resep/{id}', [ResepController::class, 'destroy'])->name('resep.destroy');
    Route::get('/resep/{id}/detail', [ResepController::class, 'detail'])->name('resep.detail');


    //  Route::get('/admin/cerita', [CeritaControll::class, 'index'])->name('cerita.index');
    // Route::get('/admin/cerita/create', [CeritaControll::class, 'create'])->name('cerita.create');
    // Route::post('/admin/cerita', [CeritaControll::class, 'store'])->name('cerita.store');
    // Route::get('/admin/cerita/{id}/edit', [CeritaControll::class, 'edit'])->name('cerita.edit');
    // Route::put('/admin/cerita/{id}', [CeritaControll::class, 'update'])->name('cerita.update');
    // Route::delete('/admin/cerita/{id}', [CeritaControll::class, 'destroy'])->name('cerita.destroy');
});

// Frontend: Lihat & Tambah Resep
Route::get('/resep', [ResepController::class, 'indexFrontend'])->name('resep.index.frontend');
Route::get('/resep/{id}', [ResepController::class, 'showFrontend'])->name('resep.show.frontend');

Route::get('/rasa', [ResepController::class, 'rasaIndex'])->name('rasa.index');
Route::post('/rasa', [ResepController::class, 'rasaStore'])->name('rasa.store');
Route::get('/rasa/{id}', [ResepController::class, 'showFrontend'])->name('rasa.show');

// =====================================================
// 🎨 RUPA (ADMIN & USER)
// =====================================================
Route::prefix('admin')->group(function () {
    Route::get('/lihatrupa', [RupaController::class, 'LihatRupa'])->name('dashboard.lihatrupa');
    Route::get('/tambahdatarupa', [RupaController::class, 'TambahRupa'])->name('tambah.rupa');
    Route::post('/datarupa', [RupaController::class, 'simpanRupa'])->name('simpanRupa');
    Route::get('/editrupa/{id}', [RupaController::class, 'edit'])->name('editrupa');
    Route::put('/updaterupa/{id}', [RupaController::class, 'update'])->name('updaterupa');
    Route::delete('/hapusrupa/{id}', [RupaController::class, 'hapusRupa'])->name('hapus.rupa');
    Route::get('/admin/rupa/{id}/detail', [RupaController::class, 'detail'])->name('detail.rupa');

});

// Frontend: Lihat Rupa
Route::get('/rupa', [Dashboard::class, 'lihatRupaUser'])->name('user.rupa');

// =====================================================
// 🛍️ MARKETPLACE (TOKO & PRODUK)
// =====================================================

// Halaman utama toko
Route::middleware('auth')->group(function () {
    // Halaman utama toko / marketplace
    Route::get('/toko', [tokoController::class, 'index'])->name('toko.index');

    // Produk berdasarkan penjual
    Route::get('/produk/{penjual_id}', [tokoController::class, 'produk'])->name('produk');

    // Detail produk
    Route::get('/detailproduk/{produk}', [tokoController::class, 'detail'])->name('detail');
});

// =====================================================
// 🧑‍💼 PENJUAL (DASHBOARD PENJUAL & PRODUK)
// =====================================================
Route::get('/dashboardpenjual', [penjualController::class, 'Penjual'])->name('penjual');

Route::prefix('penjual')->group(function () {
    Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
    Route::get('/produk/create', [ProdukController::class, 'create'])->name('produk.create');
    Route::post('/produk/store', [ProdukController::class, 'store'])->name('produk.store');
    Route::get('/produk/{id}', [ProdukController::class, 'show'])->name('produk.show');
    Route::get('/produk/{id}/edit', [ProdukController::class, 'edit'])->name('produk.edit');
    Route::put('/produk/{id}', [ProdukController::class, 'update'])->name('produk.update');
    Route::delete('/produk/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');

});

// =====================================================
// 🎭 AGENDA BUDAYA (USER & ADMIN)
// =====================================================

// User
Route::get('/agenda-budaya', [AgendaController::class, 'index'])->name('agenda.budaya');
Route::post('/agenda/store', [AgendaController::class, 'storeUser'])->name('agenda.storee');

// Admin
// Admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/agenda', [AgendaController::class, 'adminIndex'])->name('agenda.index');
    Route::get('/agenda/create', [AgendaController::class, 'create'])->name('agenda.create');
    Route::post('/agenda', [AgendaController::class, 'store'])->name('agenda.store');

    // ✅ letakkan 'detail' di atas 'edit'
    Route::get('/agenda/{id}/detail', [AgendaController::class, 'show'])->name('agenda.show');

    Route::get('/agenda/{id}/edit', [AgendaController::class, 'edit'])->name('agenda.edit');
    Route::put('/agenda/{id}', [AgendaController::class, 'update'])->name('agenda.update');
    Route::delete('/agenda/{id}', [AgendaController::class, 'destroy'])->name('agenda.destroy');
});




Route::prefix('admin/pustaka/video')->name('admin.video.')->group(function () {
    Route::get('/', [VideoController::class, 'index'])->name('index');
    Route::get('/create', [VideoController::class, 'create'])->name('create');
    Route::post('/store', [VideoController::class, 'store'])->name('store');
    Route::get('/video/{id}', [VideoController::class, 'show'])->name('show');
    Route::get('/edit/{video}', [VideoController::class, 'edit'])->name('edit');
    Route::put('/update/{video}', [VideoController::class, 'update'])->name('update');
    Route::delete('/destroy/{video}', [VideoController::class, 'destroy'])->name('destroy');
});




Route::prefix('admin/pustaka/artikel')->name('admin.artikel.')->group(function () {
    Route::get('/', [ArtikelController::class, 'index'])->name('index');
    Route::get('/tambah', [ArtikelController::class, 'create'])->name('create');
    Route::post('/simpan', [ArtikelController::class, 'store'])->name('store');
    Route::get('/{artikel}/edit', [ArtikelController::class, 'edit'])->name('edit');
    Route::get('/{artikel}', [ArtikelController::class, 'show'])->name('show'); // ✅ tambahkan ini
    Route::put('/{id}', [ArtikelController::class, 'update'])->name('update');
    Route::delete('/{id}', [ArtikelController::class, 'destroy'])->name('destroy');
});



Route::prefix('admin/pustaka/buku')->name('admin.buku.')->group(function () {
    Route::get('/', [BukuController::class, 'index'])->name('index');
    Route::get('/tambah', [BukuController::class, 'create'])->name('create');
    Route::post('/simpan', [BukuController::class, 'store'])->name('store');
    Route::get('/buku/{id}', [BukuController::class, 'show'])->name('show'); 
    Route::get('/{buku}/edit', [BukuController::class, 'edit'])->name('edit');
    Route::put('/{buku}', [BukuController::class, 'update'])->name('update');
    Route::delete('/{buku}', [BukuController::class, 'destroy'])->name('destroy');
});

// ROUTE USER PUSTAKA
Route::prefix('pustaka')->group(function () {
    
    // Buku
    Route::get('/buku', [BukuController::class, 'indexuser'])->name('user.buku.index');
   
    // Artikel
    Route::get('/artikel', [ArtikelController::class, 'indexuser'])->name('user.artikel.index');


    // Video
    Route::get('/video', [VideoController::class, 'indexuser'])->name('user.video.index');
   

});


Route::prefix('admin/cerita')->group(function () {
    Route::get('/', [CeritaController::class, 'index'])->name('cerita.index');
    Route::get('/create', [CeritaController::class, 'create'])->name('cerita.create');
    Route::post('/', [CeritaController::class, 'store'])->name('cerita.store');
    Route::get('/cerita/{id}', [CeritaController::class, 'show'])->name('cerita.show');
    Route::get('/{id}/edit', [CeritaController::class, 'edit'])->name('cerita.edit');
    Route::put('/{id}', [CeritaController::class, 'update'])->name('cerita.update');
    Route::delete('/{id}', [CeritaController::class, 'destroy'])->name('cerita.destroy');
    Route::get('/status', [CeritaController::class, 'lihatStatus'])->name('lihat.status');
    Route::post('/cerita/{id}/status', [CeritaController::class, 'ubahStatus'])->name('admin.cerita.status');
});



Route::middleware(['auth'])->prefix('user/cerita')->group(function () {
    Route::get('/', [CeritaController::class, 'userIndex'])->name('cerita.userIndex');
    Route::get('/tambah', [CeritaController::class, 'userCreate'])->name('cerita.userCreate');
    Route::post('/tambah', [CeritaController::class, 'userStore'])->name('cerita.userStore');
    Route::get('/{id}', [CeritaController::class, 'show'])->name('cerita.show');
});



//halaman daftar pengguna
Route::get('/admin-users', [UserController::class, 'userList'])->name('admin.user');
Route::get('/admin/penjual', [UserController::class, 'penjualList'])->name('admin.penjual');

//profil
// Route::middleware(['auth'])->group(function () {
//     Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
//     Route::get('/profil/edit', [ProfilController::class, 'edit'])->name('profil.edit');
//     Route::post('/profil/update', [ProfilController::class, 'update'])->name('profil.update');

// });
// Route::prefix('profile')->group(function () {
//     // Halaman profil
//     Route::get('/profile', [ProfilController::class, 'index'])->name('user.profile');

//     // Halaman edit profil
//     Route::get('/profile/edit', [ProfilController::class, 'edit'])->name('user.profile.edit');

//     // Update profil
//     Route::put('/profile/update', [ProfilController::class, 'update'])->name('user.profile.update');
// });
//profil
Route::middleware(['auth'])->group(function () {
    Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
    Route::get('/profil/edit', [ProfilController::class, 'edit'])->name('profil.edit');
    Route::post('/profil/update', [ProfilController::class, 'update'])->name('profil.update');
    Route::post('/profil/update-password', [ProfilController::class, 'updatePassword'])->name('profil.password.update');


});

Route::get('/logout', function() {
    Auth::logout();
    return redirect('/home'); // arahkan ke halaman utama setelah logout
})->name('logout');

// Route::middleware('auth')->group(function(){

//     Route::post('/beli/{produk_id}', [PesananController::class,'beli'])->name('pesanan.beli');
//     Route::get('/pesanan', [PesananController::class,'index'])->name('pesanan.index');
//     Route::post('/pesanan/item/{item_id}', [PesananController::class,'updateItem'])->name('pesanan.item.update');
//     Route::post('/pesanan/checkout', [PesananController::class,'checkout'])->name('pesanan.checkout');
//     Route::get('/pesanan/pembayaran/{pesanan_id}', [PesananController::class,'pembayaran'])->name('pesanan.pembayaran');
//     Route::post('/pesanan/bayar/{pesanan_id}', [PesananController::class,'bayar'])->name('pesanan.bayar');
//     Route::get('/pesanan/lihat', [PesananController::class,'lihat'])->name('pesanan.lihat');
//     Route::post('/pesanan/status/{pesanan_id}', [PesananController::class,'updateStatus'])->name('pesanan.status');
// });

Route::prefix('pesanan')->group(function () {
    Route::get('/', [PesananController::class,'index'])->name('pesanan.index');
    Route::post('/beli/{produk_id}', [PesananController::class,'beli'])->name('pesanan.beli');
    Route::post('/update-item/{item_id}', [PesananController::class,'updateItem'])->name('pesanan.updateItem');
    Route::post('/checkout', [PesananController::class,'checkout'])->name('pesanan.checkout');
    Route::get('/pembayaran/{pesanan_id}', [PesananController::class,'pembayaran'])->name('pesanan.pembayaran');
    Route::post('/bayar/{pesanan_id}', [PesananController::class,'bayar'])->name('pesanan.bayar');
    Route::get('/lihatPengiriman', [PesananController::class,'lihatPengiriman'])->name('pesananuser.lihat');
});

// ======================
// PENJUAL ROUTES
// ======================
Route::prefix('penjual')->group(function () {
    Route::get('/',  [penjualController::class,'index'])->name('penjual.dashboard');
    Route::get('/pesanan', [PesananController::class,'penjualPesanan'])->name('penjual.pesanan');
    
    // COD → ubah ke POST
    Route::get('/pesanan/cod/{id}', [PesananController::class,'penjualCod'])->name('penjual.pesanan.cod');
    
    // Transfer detail (opsional)
    Route::get('/pesanan/transfer/{id}', [PesananController::class,'penjualTransferDetail'])->name('penjual.transferDetail');
    
    // Konfirmasi transfer → tetap POST
    Route::get('/pesanan/transfer/konfirmasi/{id}', [PesananController::class,'penjualKonfirmasiTransfer'])->name('penjual.konfirmasi');
    
    Route::get('/pembayaran', [PesananController::class,'penjualPembayaran'])->name('penjual.pembayaran');
    Route::post('/update-status/{pesanan_id}', [PesananController::class,'penjualUpdateStatus'])->name('penjual.updateStatus');

    // User lihat status pengiriman
Route::get('/pesanan/lihat', [PesananController::class, 'lihat'])->name('pesanan.lihat');
Route::delete('/pesanan/{id}', [PesananController::class, 'destroy'])->name('pesanan.hapus');
// Terima pesanan (user klik "Terima Pesanan")
Route::post('/pesanan/terima/{id}', [PesananController::class,'terimaPesanan'])->name('pesanan.terima');

});

Route::get('/admin/marketplace', [MarketplaceController::class, 'index'])->name('admin.marketplace');



