<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function store(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $request->validate([
            'nama_kategori' => 'required|max:255|unique:kategori,nama_kategori'
        ]);

        Kategori::create($request->all());

        return redirect()->route('admin.kategori')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function update(Request $request, Kategori $kategori)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $request->validate([
            'nama_kategori' => 'required|max:255|unique:kategori,nama_kategori,' . $kategori->id
        ]);

        $kategori->update($request->all());

        return redirect()->route('admin.kategori')->with('success', 'Kategori berhasil diupdate');
    }

    public function destroy(Kategori $kategori)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        if ($kategori->artikel()->count() > 0) {
            return redirect()->route('admin.kategori')->with('error', 'Kategori tidak dapat dihapus karena masih ada artikel');
        }

        $kategori->delete();

        return redirect()->route('admin.kategori')->with('success', 'Kategori berhasil dihapus');
    }
}