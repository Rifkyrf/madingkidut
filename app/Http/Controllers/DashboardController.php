<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if ($user->role === 'admin') {
            $totalArtikel = Artikel::count();
            $artikelDraft = Artikel::where('status', 'draft')->count();
            $artikelPublish = Artikel::where('status', 'publish')->count();
            $totalUser = User::count();
            $artikel = Artikel::with(['user', 'kategori'])->latest()->take(10)->get();
        } else {
            $totalArtikel = Artikel::where('user_id', $user->id)->count();
            $artikelDraft = Artikel::where('user_id', $user->id)->where('status', 'draft')->count();
            $artikelPublish = Artikel::where('user_id', $user->id)->where('status', 'publish')->count();
            $totalUser = null;
            $artikel = Artikel::where('user_id', $user->id)->with(['kategori'])->latest()->take(10)->get();
        }

        return view('dashboard', compact('totalArtikel', 'artikelDraft', 'artikelPublish', 'totalUser', 'artikel'));
    }
}