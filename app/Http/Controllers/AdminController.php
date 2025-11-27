<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\User;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{


    public function dashboard()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }
        
        $totalArtikel = Artikel::count();
        $artikelDraft = Artikel::where('status', 'draft')->count();
        $artikelPublish = Artikel::where('status', 'publish')->count();
        $totalUser = User::count();
        
        $artikelPending = Artikel::where('status', 'draft')
            ->with(['user', 'kategori'])
            ->latest()
            ->take(10)
            ->get();
            
        $userTerbaru = User::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalArtikel', 
            'artikelDraft', 
            'artikelPublish', 
            'totalUser',
            'artikelPending',
            'userTerbaru'
        ));
    }

    public function users()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }
        $users = User::latest()->paginate(10);
        return view('admin.users', compact('users'));
    }

    public function artikel()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }
        $artikel = Artikel::with(['user', 'kategori'])->latest()->paginate(10);
        return view('admin.artikel', compact('artikel'));
    }

    public function kategori()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }
        $kategori = Kategori::withCount('artikel')->get();
        return view('admin.kategori', compact('kategori'));
    }

    public function laporan()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }
        
        $totalArtikel = Artikel::count();
        $artikelPublish = Artikel::where('status', 'publish')->count();
        $artikelDraft = Artikel::where('status', 'draft')->count();
        $totalUser = User::count();
        $totalKategori = Kategori::count();
        
        $artikelPerBulan = Artikel::selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
            ->where('status', 'publish')
            ->groupBy('bulan')
            ->get();
            
        $artikelTerbaru = Artikel::with(['user', 'kategori'])
            ->where('status', 'publish')
            ->latest()
            ->take(10)
            ->get();
            
        return view('admin.laporan', compact(
            'totalArtikel', 'artikelPublish', 'artikelDraft', 'totalUser', 'totalKategori',
            'artikelPerBulan', 'artikelTerbaru'
        ));
    }
    
    public function laporanPdf()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }
        
        $totalArtikel = Artikel::count();
        $artikelPublish = Artikel::where('status', 'publish')->count();
        $artikelDraft = Artikel::where('status', 'draft')->count();
        $totalUser = User::count();
        $totalKategori = Kategori::count();
        
        $artikelTerbaru = Artikel::with(['user', 'kategori'])
            ->where('status', 'publish')
            ->latest()
            ->take(20)
            ->get();
            
        $pdf = Pdf::loadView('admin.laporan-pdf', compact(
            'totalArtikel', 'artikelPublish', 'artikelDraft', 'totalUser', 'totalKategori',
            'artikelTerbaru'
        ));
        
        return $pdf->download('laporan-emading-' . date('Y-m-d') . '.pdf');
    }
}