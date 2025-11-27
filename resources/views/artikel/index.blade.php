@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>E-Mading Sekolah</h1>
            
            @foreach($artikel as $item)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $item->judul }}</h5>
                    <p class="card-text">{{ Str::limit($item->isi, 200) }}</p>
                    <small class="text-muted">
                        By {{ $item->user->nama }} | {{ $item->kategori->nama_kategori }} | {{ $item->tanggal->format('d M Y') }}
                    </small>
                    <div class="mt-2">
                        <a href="{{ route('artikel.show', $item) }}" class="btn btn-primary btn-sm">Baca Selengkapnya</a>
                        <span class="badge bg-secondary">{{ $item->likes->count() }} Likes</span>
                    </div>
                </div>
            </div>
            @endforeach
            
            {{ $artikel->links() }}
        </div>
    </div>
</div>
@endsection