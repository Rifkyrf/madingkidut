<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KomentarController;
use App\Http\Controllers\NotificationController;

Route::get('/', [ArtikelController::class, 'index'])->name('home');
Route::get('/artikel/{artikel}', [ArtikelController::class, 'show'])->name('artikel.show');
Route::get('/search', [ArtikelController::class, 'search'])->name('artikel.search');

// Route Login & Register
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [LoginController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [LoginController::class, 'register'])->name('register.store');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route yang memerlukan autentikasi
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function() {
        $role = auth()->user()->role;
        if ($role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($role === 'guru') {
            return redirect()->route('guru.dashboard');
        } elseif ($role === 'siswa') {
            return redirect()->route('siswa.dashboard');
        }
        return app(DashboardController::class)->index();
    })->name('dashboard');
    
    // Notification routes
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.readAll');
    Route::get('/notifications/unread-count', [NotificationController::class, 'getUnreadCount'])->name('notifications.unreadCount');
    
    // Admin routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/users', [AdminController::class, 'users'])->name('users');
        Route::get('/artikel', [AdminController::class, 'artikel'])->name('artikel');
        Route::get('/kategori', [AdminController::class, 'kategori'])->name('kategori');
        Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
        Route::put('/kategori/{kategori}', [KategoriController::class, 'update'])->name('kategori.update');
        Route::delete('/kategori/{kategori}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
        Route::get('/laporan', [AdminController::class, 'laporan'])->name('laporan');
        Route::get('/laporan/pdf', [AdminController::class, 'laporanPdf'])->name('laporan.pdf');
    });
    
    // Guru routes
    Route::prefix('guru')->name('guru.')->group(function () {
        Route::get('/dashboard', [GuruController::class, 'dashboard'])->name('dashboard');
        Route::get('/artikel', [GuruController::class, 'artikel'])->name('artikel');
        Route::get('/artikel/create', [ArtikelController::class, 'create'])->name('artikel.create');
        Route::post('/artikel', [ArtikelController::class, 'store'])->name('artikel.store');
        Route::get('/artikel/{artikel}/edit', [ArtikelController::class, 'edit'])->name('artikel.edit');
        Route::put('/artikel/{artikel}', [ArtikelController::class, 'update'])->name('artikel.update');
        Route::delete('/artikel/{artikel}', [ArtikelController::class, 'destroy'])->name('artikel.destroy');
        Route::get('/moderasi', [GuruController::class, 'moderasi'])->name('moderasi');
    });
    
    // Siswa routes
    Route::prefix('siswa')->name('siswa.')->group(function () {
        Route::get('/dashboard', [SiswaController::class, 'dashboard'])->name('dashboard');
        Route::get('/artikel', [SiswaController::class, 'artikel'])->name('artikel');
        Route::get('/artikel/create', [ArtikelController::class, 'create'])->name('artikel.create');
        Route::post('/artikel', [ArtikelController::class, 'store'])->name('artikel.store');
        Route::get('/artikel/{artikel}/edit', [ArtikelController::class, 'edit'])->name('artikel.edit');
        Route::put('/artikel/{artikel}', [ArtikelController::class, 'update'])->name('artikel.update');
    });
    
    // Artikel routes
    Route::resource('artikel', ArtikelController::class)->except(['index', 'show']);
    Route::post('/artikel/{artikel}/approve', [ArtikelController::class, 'approve'])->name('artikel.approve');
    Route::post('/artikel/{artikel}/reject', [ArtikelController::class, 'reject'])->name('artikel.reject');
    
    // Like routes
    Route::post('/artikel/{artikel}/like', [LikeController::class, 'toggle'])->name('artikel.like');
    
    // Comment routes
    Route::post('/artikel/{artikel}/komentar', [KomentarController::class, 'store'])->name('komentar.store');
    Route::delete('/komentar/{komentar}', [KomentarController::class, 'destroy'])->name('komentar.destroy');
});