<?php
// Test route untuk debug
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtikelController;

Route::get('/test-artikel/{id}', function($id) {
    $artikel = App\Models\Artikel::find($id);
    if (!$artikel) {
        return 'Artikel tidak ditemukan';
    }
    return 'Artikel ditemukan: ' . $artikel->judul;
});