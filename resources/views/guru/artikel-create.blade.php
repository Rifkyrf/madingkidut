@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Buat Artikel Baru</h1>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-success">Form Artikel</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('guru.artikel.store') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="form-group">
                            <label for="judul">Judul Artikel</label>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror" 
                                   id="judul" name="judul" value="{{ old('judul') }}" required>
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
                                    <option value="{{ $kat->id }}" {{ old('kategori_id') == $kat->id ? 'selected' : '' }}>
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
                                      id="isi" name="isi" rows="15" required>{{ old('isi') }}</textarea>
                            @error('isi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="foto">Foto Artikel (Opsional)</label>
                            <input type="file" class="form-control-file @error('foto') is-invalid @enderror" 
                                   id="foto" name="foto" accept="image/*">
                            @error('foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <a href="{{ route('guru.artikel') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-success">Simpan Artikel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-info">Panduan Guru</h6>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li><i class="fas fa-star text-warning"></i> Artikel guru langsung dipublikasi</li>
                        <li><i class="fas fa-users text-primary"></i> Berikan contoh yang baik untuk siswa</li>
                        <li><i class="fas fa-book text-success"></i> Gunakan bahasa yang edukatif</li>
                        <li><i class="fas fa-lightbulb text-info"></i> Sertakan tips pembelajaran</li>
                    </ul>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-warning">Moderasi</h6>
                </div>
                <div class="card-body">
                    <p class="text-muted small">Sebagai guru, Anda dapat memoderasi artikel siswa dan memberikan feedback yang konstruktif.</p>
                    <a href="{{ route('guru.moderasi') }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-eye"></i> Lihat Artikel Siswa
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection