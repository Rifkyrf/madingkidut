<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Kategori;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ArtikelController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        $artikel = Artikel::with(['user', 'kategori'])
            ->where('status', 'publish')
            ->latest()
            ->paginate(10);
        
        return view('index', compact('artikel'));
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        
        $artikel = Artikel::with(['user', 'kategori'])
            ->where('status', 'publish')
            ->where(function($q) use ($query) {
                $q->where('judul', 'LIKE', "%{$query}%")
                  ->orWhere('isi', 'LIKE', "%{$query}%");
            })
            ->latest()
            ->paginate(10);
        
        return view('search', compact('artikel', 'query'));
    }

    public function create()
    {
        $kategori = Kategori::all();
        $role = auth()->user()->role;
        
        if ($role === 'siswa') {
            return view('siswa.artikel-create', compact('kategori'));
        } elseif ($role === 'guru') {
            return view('guru.artikel-create', compact('kategori'));
        }
        
        return view('artikel.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'isi' => 'required',
            'kategori_id' => 'required|exists:kategori,id',
            'foto' => 'nullable|image|max:2048'
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();
        $data['tanggal'] = now();
        
        // Set status based on user role
        if (Auth::user()->role === 'admin') {
            $data['status'] = 'publish';
        } elseif (Auth::user()->role === 'guru') {
            $data['status'] = 'publish';
        } else {
            $data['status'] = 'draft'; // Siswa articles are pending
        }

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('artikel', 'public');
        }

        Artikel::create($data);

        $role = Auth::user()->role;
        if ($role === 'siswa') {
            return redirect()->route('siswa.artikel')->with('success', 'Artikel berhasil dibuat dan sedang menunggu verifikasi dari guru/admin');
        } elseif ($role === 'guru') {
            return redirect()->route('guru.artikel')->with('success', 'Artikel berhasil dibuat dan langsung dipublikasi');
        } elseif ($role === 'admin') {
            return redirect()->route('admin.artikel')->with('success', 'Artikel berhasil dibuat dan langsung dipublikasi');
        }
        
        return redirect()->route('dashboard')->with('success', 'Artikel berhasil dibuat');
    }

    public function show(Artikel $artikel)
    {
        $artikel->load(['user', 'kategori', 'likes', 'komentar.user']);
        return view('artikel.show', compact('artikel'));
    }

    public function edit(Artikel $artikel)
    {
        $this->authorize('update', $artikel);
        $kategori = Kategori::all();
        $role = auth()->user()->role;
        
        if ($role === 'siswa') {
            return view('siswa.artikel-edit', compact('artikel', 'kategori'));
        } elseif ($role === 'guru') {
            return view('guru.artikel-edit', compact('artikel', 'kategori'));
        }
        
        return view('artikel.edit', compact('artikel', 'kategori'));
    }

    public function update(Request $request, Artikel $artikel)
    {
        $this->authorize('update', $artikel);
        
        $request->validate([
            'judul' => 'required|max:255',
            'isi' => 'required',
            'kategori_id' => 'required|exists:kategori,id',
            'foto' => 'nullable|image|max:2048'
        ]);

        $data = $request->all();

        // Status remains the same when updating

        if ($request->hasFile('foto')) {
            if ($artikel->foto) {
                Storage::disk('public')->delete($artikel->foto);
            }
            $data['foto'] = $request->file('foto')->store('artikel', 'public');
        }

        $artikel->update($data);

        $role = Auth::user()->role;
        if ($role === 'siswa') {
            return redirect()->route('siswa.artikel')->with('success', 'Artikel berhasil diupdate');
        } elseif ($role === 'guru') {
            return redirect()->route('guru.artikel')->with('success', 'Artikel berhasil diupdate');
        } elseif ($role === 'admin') {
            return redirect()->route('admin.artikel')->with('success', 'Artikel berhasil diupdate');
        }
        
        return redirect()->route('dashboard')->with('success', 'Artikel berhasil diupdate');
    }

    public function destroy(Artikel $artikel)
    {
        $this->authorize('delete', $artikel);
        
        if ($artikel->foto) {
            Storage::disk('public')->delete($artikel->foto);
        }
        
        $artikel->delete();

        $role = Auth::user()->role;
        if ($role === 'siswa') {
            return redirect()->route('siswa.artikel')->with('success', 'Artikel berhasil dihapus');
        } elseif ($role === 'guru') {
            return redirect()->route('guru.artikel')->with('success', 'Artikel berhasil dihapus');
        } elseif ($role === 'admin') {
            return redirect()->route('admin.artikel')->with('success', 'Artikel berhasil dihapus');
        }
        
        return redirect()->route('dashboard')->with('success', 'Artikel berhasil dihapus');
    }

    public function approve(Artikel $artikel)
    {
        if (!in_array(Auth::user()->role, ['admin', 'guru'])) {
            abort(403);
        }

        $artikel->update(['status' => 'publish']);

        // Create notification for the article author
        if ($artikel->user->role === 'siswa') {
            Notification::create([
                'user_id' => $artikel->user_id,
                'title' => 'Artikel Disetujui',
                'message' => "Artikel Anda '{$artikel->judul}' telah disetujui dan dipublikasikan oleh " . Auth::user()->nama,
                'type' => 'success'
            ]);
        }

        return redirect()->back()->with('success', 'Artikel berhasil dipublish');
    }

    public function reject(Artikel $artikel)
    {
        if (!in_array(Auth::user()->role, ['admin', 'guru'])) {
            abort(403);
        }

        $artikel->update(['status' => 'draft']);

        // Create notification for the article author
        if ($artikel->user->role === 'siswa') {
            Notification::create([
                'user_id' => $artikel->user_id,
                'title' => 'Artikel Ditolak',
                'message' => "Artikel Anda '{$artikel->judul}' ditolak oleh " . Auth::user()->nama . ". Silakan perbaiki dan kirim ulang.",
                'type' => 'warning'
            ]);
        }

        return redirect()->back()->with('success', 'Artikel berhasil ditolak');
    }
}