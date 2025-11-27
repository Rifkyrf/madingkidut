<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuruController extends Controller
{
    public function dashboard()
    {
        if (auth()->user()->role !== 'guru') {
            abort(403);
        }
        
        $user = Auth::user();
        $totalArtikel = Artikel::where('user_id', $user->id)->count();
        $artikelDraft = Artikel::where('user_id', $user->id)->where('status', 'draft')->count();
        $artikelPublish = Artikel::where('user_id', $user->id)->where('status', 'publish')->count();
        
        $artikel = Artikel::where('user_id', $user->id)
            ->with(['kategori', 'likes'])
            ->latest()
            ->take(10)
            ->get();
            
        $artikelSiswaPending = Artikel::where('status', 'draft')
            ->whereHas('user', function($query) {
                $query->where('role', 'siswa');
            })
            ->with(['user'])
            ->latest()
            ->take(5)
            ->get();

        return view('guru.dashboard', compact(
            'totalArtikel', 
            'artikelDraft', 
            'artikelPublish',
            'artikel',
            'artikelSiswaPending'
        ));
    }

    public function artikel()
    {
        if (auth()->user()->role !== 'guru') {
            abort(403);
        }
        
        $artikel = Artikel::where('user_id', Auth::id())
            ->with(['kategori', 'likes'])
            ->latest()
            ->paginate(10);
            
        return view('guru.artikel', compact('artikel'));
    }

    public function moderasi()
    {
        if (auth()->user()->role !== 'guru') {
            abort(403);
        }
        
        $artikelSiswa = Artikel::whereHas('user', function($query) {
                $query->where('role', 'siswa');
            })
            ->with(['user', 'kategori'])
            ->latest()
            ->paginate(10);
            
        $pendingCount = Artikel::where('status', 'draft')
            ->whereHas('user', function($query) {
                $query->where('role', 'siswa');
            })
            ->count();
            
        $publishedCount = Artikel::where('status', 'publish')
            ->whereHas('user', function($query) {
                $query->where('role', 'siswa');
            })
            ->count();
            
        return view('guru.moderasi', compact('artikelSiswa', 'pendingCount', 'publishedCount'));
    }
}