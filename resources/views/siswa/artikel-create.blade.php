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
                    <h6 class="m-0 font-weight-bold text-primary">Form Artikel</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('artikel.store') }}" enctype="multipart/form-data">
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
                                      id="isi" name="isi" rows="12" required>{{ old('isi') }}</textarea>
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
                            <a href="{{ route('siswa.artikel') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan Artikel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-warning">Proses Verifikasi</h6>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> 
                        <strong>Artikel Anda akan diverifikasi oleh guru/admin sebelum dipublikasi</strong>
                    </div>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-clock text-warning"></i> Status: Pending Verifikasi</li>
                        <li><i class="fas fa-user-check text-info"></i> Diverifikasi oleh Guru/Admin</li>
                        <li><i class="fas fa-globe text-success"></i> Dipublikasi di halaman utama</li>
                    </ul>
                </div>
            </div>
            
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-info">Tips Menulis</h6>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check text-success"></i> Gunakan judul yang menarik</li>
                        <li><i class="fas fa-check text-success"></i> Tulis dengan bahasa yang mudah dipahami</li>
                        <li><i class="fas fa-check text-success"></i> Sertakan foto yang relevan</li>
                        <li><i class="fas fa-check text-success"></i> Periksa ejaan sebelum menyimpan</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection