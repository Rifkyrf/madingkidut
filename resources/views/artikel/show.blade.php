@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h1>{{ $artikel->judul }}</h1>
                    
                    <div class="mb-3">
                        <small class="text-muted">
                            By {{ $artikel->user->nama }} | 
                            {{ $artikel->kategori->nama_kategori }} | 
                            {{ $artikel->tanggal->format('d M Y') }}
                        </small>
                    </div>
                    
                    @if($artikel->foto)
                        <img src="{{ asset('storage/' . $artikel->foto) }}" class="img-fluid mb-3" alt="{{ $artikel->judul }}">
                    @endif
                    
                    <div class="article-content">
                        {!! nl2br(e($artikel->isi)) !!}
                    </div>
                    
                    @auth
                    <div class="mt-4">
                        @php
                            $userLiked = $artikel->likes->where('user_id', auth()->id())->count() > 0;
                        @endphp
                        <button id="likeBtn" class="btn {{ $userLiked ? 'btn-danger' : 'btn-outline-danger' }}" data-artikel="{{ $artikel->id }}">
                            <i class="fas fa-heart"></i> <span id="likeCount">{{ $artikel->likes->count() }}</span> Likes
                        </button>
                    </div>
                    @endauth
                    
                    <!-- Comments Section -->
                    <div class="mt-5">
                        <h4>Komentar ({{ $artikel->komentar->count() }})</h4>
                        
                        @auth
                        <!-- Comment Form -->
                        <div class="card mb-4">
                            <div class="card-body">
                                <form method="POST" action="{{ route('komentar.store', $artikel) }}">
                                    @csrf
                                    <div class="form-group">
                                        <textarea class="form-control" name="isi" rows="3" placeholder="Tulis komentar Anda..." required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="fas fa-comment"></i> Kirim Komentar
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endauth
                        
                        <!-- Comments List -->
                        @forelse($artikel->komentar->sortByDesc('created_at') as $komentar)
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">{{ $komentar->user->nama }}</h6>
                                        <small class="text-muted">{{ $komentar->created_at->diffForHumans() }}</small>
                                        <p class="mt-2 mb-0">{{ $komentar->isi }}</p>
                                    </div>
                                    @auth
                                        @if(auth()->id() === $komentar->user_id || auth()->user()->role === 'admin')
                                        <form method="POST" action="{{ route('komentar.destroy', $komentar) }}" class="d-inline" 
                                              onsubmit="return confirm('Yakin ingin menghapus komentar ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                        @endif
                                    @endauth
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-4">
                            <i class="fas fa-comments fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Belum ada komentar. Jadilah yang pertama berkomentar!</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@auth
<script>
document.addEventListener('DOMContentLoaded', function() {
    const likeBtn = document.getElementById('likeBtn');
    if (likeBtn) {
        likeBtn.addEventListener('click', function() {
            const artikelId = this.dataset.artikel;
            
            fetch(`/artikel/${artikelId}/like`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('likeCount').textContent = data.count;
                this.classList.toggle('btn-outline-danger', !data.liked);
                this.classList.toggle('btn-danger', data.liked);
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    }
});
</script>
@endauth
@endsection