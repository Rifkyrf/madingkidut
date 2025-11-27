@extends('layouts.app')

@section('title', 'Home - E-Mading')

@section('content')
<section class="breaking-news-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="breaking-news-ticker d-flex flex-wrap align-items-center">
                    <div class="title"><h6>Trending</h6></div>
                    <div id="breakingNewsTicker" class="ticker">
                        <ul>
                            @forelse($artikel->take(3) as $item)
                                <li><a href="{{ route('artikel.show', $item) }}">{{ $item->judul }}</a></li>
                            @empty
                                <li><a href="#">Belum ada artikel terbaru</a></li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="intro-news-area section-padding-100-0 mb-70">
    <div class="container-fluid" style="padding: 0 50px;">
        <div class="intro-news-filter d-flex justify-content-between mb-30">
            <h4 style="color: #ff4757; font-weight: 700; font-size: 24px;">Artikel Terbaru</h4>
        </div>
        <div class="row">
            @if($artikel->count() > 0)
                <!-- Featured Article -->
                <div class="col-12 col-md-6">
                    @php $featured = $artikel->first(); @endphp
                    <div class="single-blog-post style-1 mb-30" style="height: 650px;">
                        <div class="blog-thumbnail bg-overlay" style="height: 100%;">
                            <a href="{{ route('artikel.show', $featured) }}">
                                @if($featured->foto && file_exists(public_path('storage/' . $featured->foto)))
                                    <img src="{{ asset('storage/' . $featured->foto) }}" 
                                         alt="{{ $featured->judul }}" style="height: 100%; width: 100%; object-fit: cover;">
                                @else
                                    <img src="{{ asset('img/bg-img/1.jpg') }}" 
                                         alt="{{ $featured->judul }}" style="height: 100%; width: 100%; object-fit: cover;">
                                @endif
                            </a>
                        </div>
                        <div class="blog-content" style="position: absolute; bottom: 40px; left: 40px; right: 40px;">
                            <span class="post-date" style="color: #fff; font-size: 16px; text-transform: uppercase;">{{ $featured->tanggal->format('d M Y') }}</span>
                            <a href="{{ route('artikel.show', $featured) }}" class="post-title" style="color: #fff; font-size: 36px; font-weight: 700; line-height: 1.3; display: block; margin-top: 15px;">{{ Str::limit($featured->judul, 80) }}</a>
                            <a href="#" class="post-author" style="color: #fff; font-size: 16px; margin-top: 15px; display: inline-block; text-transform: uppercase;">By {{ $featured->user->nama }}</a>
                        </div>
                    </div>
                </div>
                
                <!-- Other Articles -->
                <div class="col-12 col-md-6">
                    <div class="row">
                        @foreach($artikel->skip(1)->take(3) as $index => $item)
                            @if($index == 0)
                                <div class="col-12">
                                    <div class="single-blog-post style-1 mb-30" style="height: 310px;">
                                        <div class="blog-thumbnail bg-overlay" style="height: 100%;">
                                            <a href="{{ route('artikel.show', $item) }}">
                                                @if($item->foto && file_exists(public_path('storage/' . $item->foto)))
                                                    <img src="{{ asset('storage/' . $item->foto) }}" 
                                                         alt="{{ $item->judul }}" style="height: 100%; width: 100%; object-fit: cover;">
                                                @else
                                                    <img src="{{ asset('img/bg-img/2.jpg') }}" 
                                                         alt="{{ $item->judul }}" style="height: 100%; width: 100%; object-fit: cover;">
                                                @endif
                                            </a>
                                        </div>
                                        <div class="blog-content" style="position: absolute; bottom: 30px; left: 30px; right: 30px;">
                                            <span class="post-date" style="color: #fff; font-size: 14px; text-transform: uppercase;">{{ $item->tanggal->format('d M Y') }}</span>
                                            <a href="{{ route('artikel.show', $item) }}" class="post-title" style="color: #fff; font-size: 24px; font-weight: 700; line-height: 1.3; display: block; margin-top: 10px;">{{ Str::limit($item->judul, 60) }}</a>
                                            <a href="#" class="post-author" style="color: #fff; font-size: 14px; margin-top: 10px; display: inline-block; text-transform: uppercase;">By {{ $item->user->nama }}</a>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="col-6">
                                    <div class="single-blog-post style-1 mb-30" style="height: 310px;">
                                        <div class="blog-thumbnail bg-overlay" style="height: 100%;">
                                            <a href="{{ route('artikel.show', $item) }}">
                                                @if($item->foto && file_exists(public_path('storage/' . $item->foto)))
                                                    <img src="{{ asset('storage/' . $item->foto) }}" 
                                                         alt="{{ $item->judul }}" style="height: 100%; width: 100%; object-fit: cover;">
                                                @else
                                                    <img src="{{ asset('img/bg-img/' . ($index + 2) . '.jpg') }}" 
                                                         alt="{{ $item->judul }}" style="height: 100%; width: 100%; object-fit: cover;">
                                                @endif
                                            </a>
                                        </div>
                                        <div class="blog-content" style="position: absolute; bottom: 20px; left: 20px; right: 20px;">
                                            <span class="post-date" style="color: #fff; font-size: 13px; text-transform: uppercase;">{{ $item->tanggal->format('d M Y') }}</span>
                                            <a href="{{ route('artikel.show', $item) }}" class="post-title" style="color: #fff; font-size: 20px; font-weight: 700; line-height: 1.2; display: block; margin-top: 8px;">{{ Str::limit($item->judul, 40) }}</a>
                                            <a href="#" class="post-author" style="color: #fff; font-size: 13px; margin-top: 8px; display: inline-block; text-transform: uppercase;">By {{ $item->user->nama }}</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @else
                <div class="col-12 text-center py-5">
                    <h3>Belum ada artikel yang dipublikasi</h3>
                    <p class="text-muted">Artikel akan muncul di sini setelah diverifikasi oleh admin/guru</p>
                </div>
            @endif
        </div>
    </div>
</section>

<!-- Additional Articles Section -->
<section class="more-articles-area section-padding-100-0 mb-70">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading text-center mb-50">
                    <h4>Artikel Lainnya</h4>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($artikel->skip(4)->take(6) as $item)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="single-blog-post style-2 mb-50">
                        <div class="blog-thumbnail">
                            <a href="{{ route('artikel.show', $item) }}">
                                @if($item->foto && file_exists(public_path('storage/' . $item->foto)))
                                    <img src="{{ asset('storage/' . $item->foto) }}" 
                                         alt="{{ $item->judul }}" style="width: 100%; height: 200px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('img/bg-img/14.jpg') }}" 
                                         alt="{{ $item->judul }}" style="width: 100%; height: 200px; object-fit: cover;">
                                @endif
                            </a>
                        </div>
                        <div class="blog-content">
                            <span class="post-date">{{ $item->tanggal->format('M d, Y') }}</span>
                            <a href="{{ route('artikel.show', $item) }}" class="post-title">{{ Str::limit($item->judul, 50) }}</a>
                            <a href="#" class="post-author">By {{ $item->user->nama }}</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection