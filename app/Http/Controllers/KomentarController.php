<?php

namespace App\Http\Controllers;

use App\Models\Komentar;
use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KomentarController extends Controller
{
    public function store(Request $request, Artikel $artikel)
    {
        $request->validate([
            'isi' => 'required|max:500'
        ]);

        Komentar::create([
            'artikel_id' => $artikel->id,
            'user_id' => Auth::id(),
            'isi' => $request->isi
        ]);

        return redirect()->route('artikel.show', $artikel)->with('success', 'Komentar berhasil ditambahkan');
    }

    public function destroy(Komentar $komentar)
    {
        if (Auth::id() !== $komentar->user_id && Auth::user()->role !== 'admin') {
            abort(403);
        }

        $artikel = $komentar->artikel;
        $komentar->delete();

        return redirect()->route('artikel.show', $artikel)->with('success', 'Komentar berhasil dihapus');
    }
}