<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    public function dashboard()
    {
        if (auth()->user()->role !== 'siswa') {
            abort(403);
        }
        
        $user = Auth::user();
        $totalArtikel = Artikel::where('user_id', $user->id)->count();
        $artikelPending = Artikel::where('user_id', $user->id)->where('status', 'draft')->count();
        $artikelPublish = Artikel::where('user_id', $user->id)->where('status', 'publish')->count();
        
        $artikel = Artikel::where('user_id', $user->id)
            ->with(['kategori', 'likes'])
            ->latest()
            ->take(10)
            ->get();
            
        $artikelPopuler = Artikel::where('status', 'publish')
            ->withCount('likes')
            ->orderBy('likes_count', 'desc')
            ->take(5)
            ->get();

        // Get notifications
        $unreadNotifications = Notification::where('user_id', $user->id)
            ->where('is_read', false)
            ->count();
            
        $recentNotifications = Notification::where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        return view('siswa.dashboard', compact(
            'totalArtikel', 
            'artikelPending', 
            'artikelPublish',
            'artikel',
            'artikelPopuler',
            'unreadNotifications',
            'recentNotifications'
        ));
    }

    public function artikel()
    {
        if (auth()->user()->role !== 'siswa') {
            abort(403);
        }
        
        $artikel = Artikel::where('user_id', Auth::id())
            ->with(['kategori', 'likes'])
            ->latest()
            ->paginate(10);
            
        return view('siswa.artikel', compact('artikel'));
    }
}