@extends('layouts.admin')

@section('title', 'Artikel Saya - E-Mading')
@section('sidebar-color', 'info')
@section('user-badge', 'info')

@section('sidebar')
<!-- Nav Item - Dashboard -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('siswa.dashboard') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span>
    </a>
</li>

<!-- Nav Item - Home -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('home') }}">
        <i class="fas fa-fw fa-home"></i>
        <span>Halaman Utama</span>
    </a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">Artikel</div>

<!-- Nav Item - Create Article -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('siswa.artikel.create') }}">
        <i class="fas fa-fw fa-plus-circle"></i>
        <span>Buat Artikel</span>
    </a>
</li>

<!-- Nav Item - My Articles -->
<li class="nav-item active">
    <a class="nav-link" href="{{ route('siswa.artikel') }}">
        <i class="fas fa-fw fa-newspaper"></i>
        <span>Artikel Saya</span>
    </a>
</li>
@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Artikel Saya</h1>
    <a href="{{ route('siswa.artikel.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Buat Artikel
    </a>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Semua Artikel Saya</h6>
    </div>
    <div class="card-body">
        @if($artikel->count() > 0)
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Likes</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($artikel as $item)
                    <tr>
                        <td>
                            <div class="font-weight-bold">{{ Str::limit($item->judul, 50) }}</div>
                            <small class="text-muted">{{ Str::limit($item->isi, 80) }}</small>
                        </td>
                        <td><span class="badge badge-secondary">{{ $item->kategori->nama_kategori }}</span></td>
                        <td>
                            <span class="badge badge-{{ $item->status === 'publish' ? 'success' : 'warning' }}">
                                {{ $item->status === 'publish' ? 'Published' : 'Pending Verifikasi' }}
                            </span>
                        </td>
                        <td>
                            <div>{{ $item->tanggal->format('d M Y') }}</div>
                            <small class="text-muted">{{ $item->tanggal->diffForHumans() }}</small>
                        </td>
                        <td>
                            <span class="badge badge-info">{{ $item->likes->count() }} <i class="fas fa-heart"></i></span>
                        </td>
                        <td>
                            <div class="btn-group-vertical btn-group-sm">
                                <a href="{{ route('artikel.show', $item) }}" class="btn btn-info btn-sm mb-1">
                                    <i class="fas fa-eye"></i> Lihat
                                </a>
                                @if($item->status === 'draft')
                                    <a href="{{ route('siswa.artikel.edit', $item) }}" class="btn btn-warning btn-sm mb-1">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form method="POST" action="{{ route('artikel.destroy', $item) }}" class="d-inline" 
                                          onsubmit="return confirm('Yakin ingin menghapus artikel ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                @else
                                    <span class="btn btn-secondary btn-sm disabled">
                                        <i class="fas fa-lock"></i> Published
                                    </span>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $artikel->links() }}
        </div>
        @else
        <div class="text-center py-5">
            <i class="fas fa-newspaper fa-4x text-muted mb-4"></i>
            <h4 class="text-muted mb-3">Belum ada artikel</h4>
            <p class="text-muted mb-4">Mulai menulis artikel pertama Anda dan bagikan ide kreatif!</p>
            <a href="{{ route('siswa.artikel.create') }}" class="btn btn-primary btn-lg">
                <i class="fas fa-plus mr-2"></i>Buat Artikel Pertama
            </a>
        </div>
        @endif
    </div>
</div>
@endsection