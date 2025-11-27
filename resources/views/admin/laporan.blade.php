@extends('layouts.admin')

@section('title', 'Laporan - E-Mading')
@section('sidebar-color', 'primary')
@section('user-badge', 'primary')

@section('sidebar')
<!-- Nav Item - Dashboard -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('admin.dashboard') }}">
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
<div class="sidebar-heading">Manajemen</div>

<!-- Nav Item - Users -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('admin.users') }}">
        <i class="fas fa-fw fa-users"></i>
        <span>Kelola User</span>
    </a>
</li>

<!-- Nav Item - Articles -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('admin.artikel') }}">
        <i class="fas fa-fw fa-newspaper"></i>
        <span>Kelola Artikel</span>
    </a>
</li>

<!-- Nav Item - Categories -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('admin.kategori') }}">
        <i class="fas fa-fw fa-tags"></i>
        <span>Kelola Kategori</span>
    </a>
</li>

<!-- Nav Item - Reports -->
<li class="nav-item active">
    <a class="nav-link" href="{{ route('admin.laporan') }}">
        <i class="fas fa-fw fa-chart-bar"></i>
        <span>Laporan</span>
    </a>
</li>
@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Laporan E-Mading</h1>
    <a href="{{ route('admin.laporan.pdf') }}" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm">
        <i class="fas fa-download fa-sm text-white-50"></i> Download PDF
    </a>
</div>

<!-- Content Row -->
<div class="row">
    <!-- Total Articles Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Artikel</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalArtikel }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-newspaper fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Published Articles Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Artikel Published</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $artikelPublish }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Draft Articles Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Artikel Draft</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $artikelDraft }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clock fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Users Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Users</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalUser }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Row -->
<div class="row">
    <!-- Latest Articles -->
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Artikel Terbaru (Published)</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Penulis</th>
                                <th>Kategori</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($artikelTerbaru as $artikel)
                            <tr>
                                <td>
                                    <div class="font-weight-bold">{{ Str::limit($artikel->judul, 50) }}</div>
                                    <small class="text-muted">{{ Str::limit($artikel->isi, 80) }}</small>
                                </td>
                                <td>
                                    <div>{{ $artikel->user->name }}</div>
                                    <small class="text-muted">{{ ucfirst($artikel->user->role) }}</small>
                                </td>
                                <td><span class="badge badge-secondary">{{ $artikel->kategori->nama_kategori }}</span></td>
                                <td>
                                    <div>{{ $artikel->tanggal->format('d M Y') }}</div>
                                    <small class="text-muted">{{ $artikel->tanggal->diffForHumans() }}</small>
                                </td>
                                <td><span class="badge badge-success">Published</span></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    <i class="fas fa-newspaper fa-3x text-muted mb-3"></i><br>
                                    <strong>Belum ada artikel published</strong>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection