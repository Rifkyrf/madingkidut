@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Dashboard E-Mading</h1>
            
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card text-white bg-primary">
                        <div class="card-body">
                            <h5>Total Artikel</h5>
                            <h2>{{ $totalArtikel }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-warning">
                        <div class="card-body">
                            <h5>Draft</h5>
                            <h2>{{ $artikelDraft }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-success">
                        <div class="card-body">
                            <h5>Published</h5>
                            <h2>{{ $artikelPublish }}</h2>
                        </div>
                    </div>
                </div>
                @if($totalUser)
                <div class="col-md-3">
                    <div class="card text-white bg-info">
                        <div class="card-body">
                            <h5>Total User</h5>
                            <h2>{{ $totalUser }}</h2>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>Artikel Terbaru</h3>
                <a href="{{ route('artikel.create') }}" class="btn btn-primary">Buat Artikel</a>
            </div>
            
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Penulis</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($artikel as $item)
                        <tr>
                            <td>{{ $item->judul }}</td>
                            <td>{{ $item->kategori->nama_kategori }}</td>
                            <td>{{ $item->user->nama }}</td>
                            <td>
                                <span class="badge bg-{{ $item->status == 'publish' ? 'success' : 'warning' }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                            <td>{{ $item->tanggal->format('d M Y') }}</td>
                            <td>
                                <a href="{{ route('artikel.show', $item) }}" class="btn btn-sm btn-info">Lihat</a>
                                @if(auth()->user()->role === 'admin' || auth()->user()->id === $item->user_id)
                                    <a href="{{ route('artikel.edit', $item) }}" class="btn btn-sm btn-warning">Edit</a>
                                @endif
                                @if(auth()->user()->role === 'admin' && $item->status === 'draft')
                                    <form method="POST" action="{{ route('artikel.approve', $item) }}" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
