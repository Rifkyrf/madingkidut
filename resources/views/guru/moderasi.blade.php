@extends('layouts.admin')

@section('title', 'Moderasi Artikel - E-Mading')
@section('sidebar-color', 'warning')
@section('user-badge', 'warning')

@section('sidebar')
<!-- Nav Item - Dashboard -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('guru.dashboard') }}">
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
    <a class="nav-link" href="{{ route('guru.artikel.create') }}">
        <i class="fas fa-fw fa-plus-circle"></i>
        <span>Buat Artikel</span>
    </a>
</li>

<!-- Nav Item - My Articles -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('guru.artikel') }}">
        <i class="fas fa-fw fa-newspaper"></i>
        <span>Artikel Saya</span>
    </a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">Moderasi</div>

<!-- Nav Item - Moderation -->
<li class="nav-item active">
    <a class="nav-link" href="{{ route('guru.moderasi') }}">
        <i class="fas fa-fw fa-user-check"></i>
        <span>Moderasi Artikel</span>
    </a>
</li>
@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Moderasi Artikel Siswa</h1>
</div>

<!-- Content Row -->
<div class="row">
    <!-- Pending Articles -->
    <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Artikel Pending</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pendingCount }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clock fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Published Articles -->
    <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Artikel Published</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $publishedCount }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Artikel Siswa</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Penulis</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($artikelSiswa as $item)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="mr-3">
                                    <div class="icon-circle bg-info">
                                        <i class="fas fa-user text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="font-weight-bold">{{ $item->user->name }}</div>
                                    <small class="text-muted">{{ $item->user->email }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="font-weight-bold">{{ Str::limit($item->judul, 40) }}</div>
                            <small class="text-muted">{{ Str::limit($item->isi, 60) }}</small>
                        </td>
                        <td><span class="badge badge-secondary">{{ $item->kategori->nama_kategori }}</span></td>
                        <td>
                            <span class="badge badge-{{ $item->status === 'publish' ? 'success' : 'warning' }}">
                                {{ $item->status === 'publish' ? 'Published' : 'Pending' }}
                            </span>
                        </td>
                        <td>
                            <div>{{ $item->tanggal->format('d M Y') }}</div>
                            <small class="text-muted">{{ $item->tanggal->diffForHumans() }}</small>
                        </td>
                        <td>
                            <div class="btn-group-vertical btn-group-sm">
                                <a href="{{ route('artikel.show', $item) }}" class="btn btn-info btn-sm mb-1">
                                    <i class="fas fa-eye"></i> Lihat
                                </a>
                                <a href="{{ route('guru.artikel.edit', $item) }}" class="btn btn-warning btn-sm mb-1">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                @if($item->status === 'draft')
                                    <form method="POST" action="{{ route('artikel.approve', $item) }}" class="d-inline mb-1">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm" 
                                                onclick="return confirm('Publikasikan artikel ini?')">
                                            <i class="fas fa-check"></i> Publish
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('artikel.reject', $item) }}" class="d-inline mb-1">
                                        @csrf
                                        <button type="submit" class="btn btn-warning btn-sm" 
                                                onclick="return confirm('Tolak artikel ini?')">
                                            <i class="fas fa-times"></i> Tolak
                                        </button>
                                    </form>
                                @endif
                                <form method="POST" action="{{ route('guru.artikel.destroy', $item) }}" class="d-inline" 
                                      onsubmit="return confirm('Yakin ingin menghapus artikel ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <i class="fas fa-users fa-3x text-muted mb-3"></i><br>
                            <strong>Belum ada artikel siswa</strong><br>
                            <small class="text-muted">Artikel siswa akan muncul di sini untuk dimoderasi</small>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $artikelSiswa->links() }}
        </div>
    </div>
</div>
@endsection