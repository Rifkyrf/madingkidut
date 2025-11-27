@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Artikel</h1>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-success">Form Edit Artikel</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('guru.artikel.update', $artikel) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label for="judul">Judul Artikel</label>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror" 
                                   id="judul" name="judul" value="{{ old('judul', $artikel->judul) }}" required>
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="kategori_id">Kategori</label>
                            <select class="form-control @error('kategori_id') is-invalid @enderror" 
                                    id="kategori_id" name="kategori_id" required>
                                <option value="">Pilih Kategori</option>
                                @foreach($kategori as $kat)
                                    <option value="{{ $kat->id }}" 
                                        {{ old('kategori_id', $artikel->kategori_id) == $kat->id ? 'selected' : '' }}>
                                        {{ $kat->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kategori_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="isi">Isi Artikel</label>
                            <textarea class="form-control @error('isi') is-invalid @enderror" 
                                      id="isi" name="isi" rows="15" required>{{ old('isi', $artikel->isi) }}</textarea>
                            @error('isi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="foto">Foto Artikel</label>
                            @if($artikel->foto)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $artikel->foto) }}" class="img-thumbnail" width="200">
                                    <p class="text-muted small">Foto saat ini</p>
                                </div>
                            @endif
                            <input type="file" class="form-control-file @error('foto') is-invalid @enderror" 
                                   id="foto" name="foto" accept="image/*">
                            <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah foto</small>
                            @error('foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <a href="{{ route('guru.artikel') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-success">Update Artikel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-info">Info Artikel</h6>
                </div>
                <div class="card-body">
                    <p><strong>Penulis:</strong> {{ $artikel->user->nama }}</p>
                    <p><strong>Status:</strong> 
                        <span class="badge badge-{{ $artikel->status == 'publish' ? 'success' : 'warning' }}">
                            {{ $artikel->status == 'publish' ? 'Dipublikasi' : 'Draft' }}
                        </span>
                    </p>
                    <p><strong>Dibuat:</strong> {{ $artikel->tanggal->format('d M Y H:i') }}</p>
                    <p><strong>Kategori:</strong> {{ $artikel->kategori->nama_kategori }}</p>
                </div>
            </div>

            @if($artikel->user->role == 'siswa' && auth()->user()->role == 'guru')
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-warning">Aksi Moderasi</h6>
                </div>
                <div class="card-body">
                    @if($artikel->status == 'draft')
                        <form method="POST" action="{{ route('artikel.approve', $artikel) }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm" 
                                    onclick="return confirm('Publikasikan artikel ini?')">
                                <i class="fas fa-check"></i> Publikasikan
                            </button>
                        </form>
                    @endif
                    <p class="text-muted small mt-2">Artikel siswa yang sudah dipublikasi dapat diedit oleh guru untuk perbaikan.</p>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection