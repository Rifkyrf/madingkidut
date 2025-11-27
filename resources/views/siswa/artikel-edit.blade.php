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
                    <h6 class="m-0 font-weight-bold text-primary">Form Edit Artikel</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('siswa.artikel.update', $artikel) }}" enctype="multipart/form-data">
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
                                      id="isi" name="isi" rows="12" required>{{ old('isi', $artikel->isi) }}</textarea>
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
                            <a href="{{ route('siswa.artikel') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">Update Artikel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-warning">Status Artikel</h6>
                </div>
                <div class="card-body">
                    <p><strong>Status:</strong> 
                        <span class="badge badge-{{ $artikel->status == 'publish' ? 'success' : 'warning' }}">
                            {{ $artikel->status == 'publish' ? 'Dipublikasi' : 'Pending Verifikasi' }}
                        </span>
                    </p>
                    <p><strong>Dibuat:</strong> {{ $artikel->tanggal->format('d M Y H:i') }}</p>
                    @if($artikel->status == 'publish')
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle"></i> 
                            <strong>Artikel sudah dipublikasi!</strong><br>
                            <small>Artikel Anda telah diverifikasi dan dapat dilihat di halaman utama</small>
                        </div>
                    @else
                        <div class="alert alert-warning">
                            <i class="fas fa-clock"></i> 
                            <strong>Menunggu Verifikasi</strong><br>
                            <small>Artikel Anda sedang menunggu verifikasi dari guru/admin</small>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection