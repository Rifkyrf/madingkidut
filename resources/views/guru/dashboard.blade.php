@extends('layouts.admin')

@section('title', 'Guru Dashboard - E-Mading')
@section('sidebar-color', 'warning')
@section('user-badge', 'warning')

@section('sidebar')
<!-- Nav Item - Dashboard -->
<li class="nav-item active">
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
<li class="nav-item">
    <a class="nav-link" href="{{ route('guru.moderasi') }}">
        <i class="fas fa-fw fa-user-check"></i>
        <span>Moderasi Artikel</span>
    </a>
</li>
@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard Guru</h1>
    <a href="{{ route('guru.artikel.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Buat Artikel
    </a>
</div>

<!-- Content Row -->
<div class="row">
    <!-- My Articles Card -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Artikel Saya</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalArtikel }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-newspaper fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Draft Articles Card -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Draft</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $artikelDraft }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-edit fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Published Articles Card -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Published</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $artikelPublish }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Row -->
<div class="row">
    <!-- My Recent Articles -->
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Artikel Terbaru Saya</h6>
                <a href="{{ route('guru.artikel') }}" class="btn btn-primary btn-sm">Lihat Semua</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Status</th>
                                <th>Likes</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($artikel as $item)
                            <tr>
                                <td>
                                    <strong>{{ Str::limit($item->judul, 40) }}</strong><br>
                                    <small class="text-muted">{{ $item->tanggal->format('d M Y') }}</small>
                                </td>
                                <td><span class="badge badge-secondary">{{ $item->kategori->nama_kategori }}</span></td>
                                <td>
                                    <span class="badge badge-{{ $item->status == 'publish' ? 'success' : 'warning' }}">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </td>
                                <td><span class="badge badge-info">{{ $item->likes->count() }}</span></td>
                                <td>
                                    <a href="{{ route('artikel.show', $item) }}" class="btn btn-info btn-sm">Lihat</a>
                                    <a href="{{ route('artikel.edit', $item) }}" class="btn btn-warning btn-sm">Edit</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">
                                    <i class="fas fa-newspaper fa-3x text-muted mb-3"></i><br>
                                    <strong>Belum ada artikel</strong><br>
                                    <small class="text-muted">Mulai menulis artikel pertama Anda!</small><br>
                                    <a href="{{ route('guru.artikel.create') }}" class="btn btn-primary btn-sm mt-2">Buat Artikel</a>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Student Articles Pending -->
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Artikel Siswa Pending</h6>
            </div>
            <div class="card-body">
                @forelse($artikelSiswaPending as $item)
                <div class="border-left-warning p-3 mb-3">
                    <div class="font-weight-bold">{{ Str::limit($item->judul, 30) }}</div>
                    <div class="small text-muted mb-2">{{ Str::limit($item->isi, 60) }}</div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <small class="text-muted">{{ $item->user->nama }}</small>
                        <small class="text-muted">{{ $item->tanggal->format('d M Y') }}</small>
                    </div>
                    <div class="btn-group btn-group-sm w-100">
                        <a href="{{ route('artikel.show', $item) }}" class="btn btn-info">Lihat</a>
                        <form method="POST" action="{{ route('artikel.approve', $item) }}" class="flex-fill">
                            @csrf
                            <button type="submit" class="btn btn-success w-100">Approve</button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="text-center">
                    <i class="fas fa-clipboard-check fa-3x text-muted mb-3"></i><br>
                    <strong>Tidak ada artikel siswa yang pending</strong><br>
                    <small class="text-muted">Semua artikel sudah dimoderasi</small>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection