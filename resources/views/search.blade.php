@extends('layouts.app')

@section('title', 'Hasil Pencarian - E-Mading')

@section('content')
<section class="breaking-news-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="breaking-news-ticker d-flex flex-wrap align-items-center">
                    <div class="title"><h6>Pencarian</h6></div>
                    <div class="ticker">
                        <span>Hasil pencarian untuk: "{{ $query }}"</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="intro-news-area section-padding-100-0 mb-70">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="intro-news-filter d-flex justify-content-between align-items-center mb-30">
                    <h4 style="color: #ff4757; font-weight: 700; font-size: 24px;">
                        Hasil Pencarian: "{{ $query }}"
                    </h4>
                    <span class="text-muted">{{ $artikel->total() }} artikel ditemukan</span>
                </div>
            </div>
        </div>

        @if($artikel->count() > 0)
            <div class="row">
                @foreach($artikel as $item)
                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                        <div class="single-blog-post style-2">
                            <div class="blog-thumbnail">
                                <a href="{{ route('artikel.show', $item) }}">
                                    @if($item->foto && file_exists(public_path('storage/' . $item->foto)))
                                        <img src="{{ asset('storage/' . $item->foto) }}" 
                                             alt="{{ $item->judul }}" 
                                             style="width: 100%; height: 200px; object-fit: cover;">
                                    @else
                                        <img src="{{ asset('img/bg-img/14.jpg') }}" 
                                             alt="{{ $item->judul }}" 
                                             style="width: 100%; height: 200px; object-fit: cover;">
                                    @endif
                                </a>
                            </div>
                            <div class="blog-content">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="post-date">{{ $item->tanggal->format('M d, Y') }}</span>
                                    <span class="badge badge-primary">{{ $item->kategori->nama_kategori }}</span>
                                </div>
                                <a href="{{ route('artikel.show', $item) }}" class="post-title">
                                    {{ Str::limit($item->judul, 60) }}
                                </a>
                                <p class="text-muted mt-2" style="font-size: 14px;">
                                    {{ Str::limit(strip_tags($item->isi), 100) }}
                                </p>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <a href="#" class="post-author">By {{ $item->user->nama }}</a>
                                    <div class="article-stats">
                                        <small class="text-muted">
                                            <i class="fas fa-heart"></i> {{ $item->likes->count() }}
                                            <i class="fas fa-comment ml-2"></i> {{ $item->komentar->count() }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-center">
                        {{ $artikel->appends(['q' => $query])->links() }}
                    </div>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-12">
                    <div class="text-center py-5">
                        <div class="mb-4">
                            <i class="fas fa-search" style="font-size: 4rem; color: #ddd;"></i>
                        </div>
                        <h3>Tidak ada artikel ditemukan</h3>
                        <p class="text-muted">Coba gunakan kata kunci yang berbeda atau lebih umum</p>
                        <div class="mt-4">
                            <a href="{{ route('home') }}" class="btn btn-primary">
                                <i class="fas fa-home"></i> Kembali ke Beranda
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>

<style>
.badge {
    font-size: 0.75rem;
    padding: 0.25rem 0.5rem;
}

.badge-primary {
    background-color: #ff4757;
    color: white;
}

.single-blog-post {
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
    overflow: hidden;
}

.single-blog-post:hover {
    transform: translateY(-5px);
}

.blog-thumbnail {
    overflow: hidden;
}

.blog-thumbnail img {
    transition: transform 0.3s ease;
}

.single-blog-post:hover .blog-thumbnail img {
    transform: scale(1.05);
}

.post-title {
    color: #333;
    font-weight: 600;
    text-decoration: none;
    display: block;
    margin-bottom: 0.5rem;
}

.post-title:hover {
    color: #ff4757;
}

.post-author {
    color: #666;
    text-decoration: none;
    font-size: 0.9rem;
}

.post-author:hover {
    color: #ff4757;
}

.article-stats i {
    margin-right: 3px;
}
</style>
@endsection