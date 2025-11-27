@extends('layouts.app')

@section('title', 'Tulis Artikel - E-Mading')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Header -->
            <div class="text-center mb-5">
                <h1 class="display-4 text-primary mb-3">
                    <i class="fas fa-pen-fancy"></i> Tulis Artikel
                </h1>
                <p class="lead text-muted">Bagikan ide dan pemikiran Anda dengan komunitas</p>
            </div>

            <div class="row">
                <!-- Form Column -->
                <div class="col-lg-8">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-gradient-primary text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-edit"></i> Form Artikel
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <form method="POST" action="{{ route('artikel.store') }}" enctype="multipart/form-data">
                                @csrf
                                
                                <!-- Judul -->
                                <div class="form-group mb-4">
                                    <label for="judul" class="form-label fw-bold">
                                        <i class="fas fa-heading text-primary"></i> Judul Artikel
                                    </label>
                                    <input type="text" 
                                           class="form-control form-control-lg @error('judul') is-invalid @enderror" 
                                           id="judul" 
                                           name="judul" 
                                           value="{{ old('judul') }}" 
                                           placeholder="Masukkan judul artikel yang menarik..."
                                           required>
                                    @error('judul')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Kategori -->
                                <div class="form-group mb-4">
                                    <label for="kategori_id" class="form-label fw-bold">
                                        <i class="fas fa-tags text-primary"></i> Kategori
                                    </label>
                                    <select class="form-select form-select-lg @error('kategori_id') is-invalid @enderror" 
                                            id="kategori_id" 
                                            name="kategori_id" 
                                            required>
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

                                <!-- Foto -->
                                <div class="form-group mb-4">
                                    <label for="foto" class="form-label fw-bold">
                                        <i class="fas fa-image text-primary"></i> Foto Artikel (Opsional)
                                    </label>
                                    <div class="input-group">
                                        <input type="file" 
                                               class="form-control @error('foto') is-invalid @enderror" 
                                               id="foto" 
                                               name="foto" 
                                               accept="image/*"
                                               onchange="previewImage(this)">
                                        <label class="input-group-text" for="foto">
                                            <i class="fas fa-upload"></i>
                                        </label>
                                    </div>
                                    <small class="form-text text-muted">
                                        <i class="fas fa-info-circle"></i> Format: JPG, PNG, GIF. Maksimal 2MB
                                    </small>
                                    @error('foto')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                    
                                    <!-- Preview Image -->
                                    <div id="imagePreview" class="mt-3" style="display: none;">
                                        <img id="preview" src="" alt="Preview" class="img-fluid rounded shadow" style="max-height: 200px;">
                                    </div>
                                </div>

                                <!-- Isi Artikel -->
                                <div class="form-group mb-4">
                                    <label for="isi" class="form-label fw-bold">
                                        <i class="fas fa-align-left text-primary"></i> Isi Artikel
                                    </label>
                                    <textarea class="form-control @error('isi') is-invalid @enderror" 
                                              id="isi" 
                                              name="isi" 
                                              rows="15" 
                                              placeholder="Tulis artikel Anda di sini... Ceritakan pengalaman, ide, atau pengetahuan yang ingin Anda bagikan."
                                              required>{{ old('isi') }}</textarea>
                                    @error('isi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">
                                        <small class="text-muted">
                                            <i class="fas fa-lightbulb"></i> 
                                            Tips: Gunakan paragraf yang jelas dan bahasa yang mudah dipahami
                                        </small>
                                    </div>
                                </div>

                                <!-- Buttons -->
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary btn-lg">
                                        <i class="fas fa-arrow-left"></i> Kembali
                                    </a>
                                    <div>
                                        <button type="button" class="btn btn-outline-primary btn-lg me-2" onclick="saveDraft()">
                                            <i class="fas fa-save"></i> Simpan Draft
                                        </button>
                                        <button type="submit" class="btn btn-primary btn-lg">
                                            <i class="fas fa-paper-plane"></i> Publikasikan
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Tips Card -->
                    <div class="card shadow border-0 mb-4">
                        <div class="card-header bg-gradient-success text-white">
                            <h6 class="mb-0">
                                <i class="fas fa-lightbulb"></i> Tips Menulis
                            </h6>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-0">
                                <li class="mb-2">
                                    <i class="fas fa-check-circle text-success"></i>
                                    Gunakan judul yang menarik dan deskriptif
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check-circle text-success"></i>
                                    Pilih kategori yang sesuai dengan topik
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check-circle text-success"></i>
                                    Tambahkan foto untuk menarik perhatian
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check-circle text-success"></i>
                                    Tulis dengan bahasa yang jelas dan mudah dipahami
                                </li>
                                <li class="mb-0">
                                    <i class="fas fa-check-circle text-success"></i>
                                    Periksa kembali sebelum mempublikasikan
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Status Card -->
                    <div class="card shadow border-0 mb-4">
                        <div class="card-header bg-gradient-info text-white">
                            <h6 class="mb-0">
                                <i class="fas fa-info-circle"></i> Status Publikasi
                            </h6>
                        </div>
                        <div class="card-body">
                            @if(auth()->user()->role === 'admin')
                                <div class="alert alert-success mb-0">
                                    <i class="fas fa-crown"></i>
                                    <strong>Admin:</strong> Artikel akan langsung dipublikasikan
                                </div>
                            @elseif(auth()->user()->role === 'guru')
                                <div class="alert alert-primary mb-0">
                                    <i class="fas fa-user-tie"></i>
                                    <strong>Guru:</strong> Artikel akan langsung dipublikasikan
                                </div>
                            @else
                                <div class="alert alert-warning mb-0">
                                    <i class="fas fa-clock"></i>
                                    <strong>Siswa:</strong> Artikel akan direview terlebih dahulu
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Recent Articles -->
                    <div class="card shadow border-0">
                        <div class="card-header bg-gradient-secondary text-white">
                            <h6 class="mb-0">
                                <i class="fas fa-newspaper"></i> Artikel Terbaru
                            </h6>
                        </div>
                        <div class="card-body">
                            @php
                                $recentArticles = App\Models\Artikel::with('user')
                                    ->where('status', 'publish')
                                    ->latest()
                                    ->take(3)
                                    ->get();
                            @endphp
                            
                            @forelse($recentArticles as $recent)
                                <div class="d-flex mb-3">
                                    <div class="flex-shrink-0">
                                        <img src="{{ $recent->foto ? asset('storage/' . $recent->foto) : 'https://via.placeholder.com/60x60' }}" 
                                             alt="{{ $recent->judul }}" 
                                             class="rounded" 
                                             style="width: 60px; height: 60px; object-fit: cover;">
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1">
                                            <a href="{{ route('artikel.show', $recent) }}" class="text-decoration-none">
                                                {{ Str::limit($recent->judul, 40) }}
                                            </a>
                                        </h6>
                                        <small class="text-muted">
                                            {{ $recent->tanggal->diffForHumans() }}
                                        </small>
                                    </div>
                                </div>
                            @empty
                                <p class="text-muted mb-0">Belum ada artikel terbaru</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bg-gradient-primary {
    background: linear-gradient(45deg, #007bff, #0056b3);
}
.bg-gradient-success {
    background: linear-gradient(45deg, #28a745, #1e7e34);
}
.bg-gradient-info {
    background: linear-gradient(45deg, #17a2b8, #117a8b);
}
.bg-gradient-secondary {
    background: linear-gradient(45deg, #6c757d, #545b62);
}
.card {
    transition: transform 0.2s;
}
.card:hover {
    transform: translateY(-2px);
}
</style>

<script>
function previewImage(input) {
    const preview = document.getElementById('preview');
    const previewDiv = document.getElementById('imagePreview');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.src = e.target.result;
            previewDiv.style.display = 'block';
        }
        
        reader.readAsDataURL(input.files[0]);
    } else {
        previewDiv.style.display = 'none';
    }
}

function saveDraft() {
    // Implementasi save draft jika diperlukan
    alert('Fitur save draft akan segera tersedia!');
}

// Auto-resize textarea
document.getElementById('isi').addEventListener('input', function() {
    this.style.height = 'auto';
    this.style.height = (this.scrollHeight) + 'px';
});
</script>
@endsection