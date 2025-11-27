@extends('layouts.admin')

@section('title', 'Siswa Dashboard - E-Mading')
@section('sidebar-color', 'info')
@section('user-badge', 'info')

@section('sidebar')
<!-- Nav Item - Dashboard -->
<li class="nav-item active">
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
<li class="nav-item">
    <a class="nav-link" href="{{ route('siswa.artikel') }}">
        <i class="fas fa-fw fa-newspaper"></i>
        <span>Artikel Saya</span>
    </a>
</li>

<!-- Nav Item - Notifications -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('notifications.index') }}">
        <i class="fas fa-fw fa-bell"></i>
        <span>Notifikasi</span>
        @if($unreadNotifications > 0)
            <span class="badge badge-danger badge-counter">{{ $unreadNotifications }}</span>
        @endif
    </a>
</li>
@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div>
        <h1 class="h3 mb-0 text-gray-800">Dashboard Siswa</h1>
        <p class="mb-0 text-muted">Selamat datang, {{ Auth::user()->nama }}!</p>
    </div>
    <a href="{{ route('siswa.artikel.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Buat Artikel
    </a>
</div>

<!-- Notifications Alert -->
@if($unreadNotifications > 0)
<div class="alert alert-info alert-dismissible fade show mb-4" role="alert">
    <i class="fas fa-bell mr-2"></i>
    <strong>Anda memiliki {{ $unreadNotifications }} notifikasi baru!</strong>
    <a href="{{ route('notifications.index') }}" class="alert-link">Lihat semua notifikasi</a>
    <button type="button" class="close" data-dismiss="alert">
        <span>&times;</span>
    </button>
</div>
@endif

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

    <!-- Pending Articles Card -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending Verifikasi</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $artikelPending }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clock fa-2x text-gray-300"></i>
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
                <a href="{{ route('siswa.artikel') }}" class="btn btn-primary btn-sm">Lihat Semua</a>
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
                                <th>Likes</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($artikel as $item)
                            <tr>
                                <td>
                                    <strong>{{ Str::limit($item->judul, 40) }}</strong><br>
                                    <small class="text-muted">{{ $item->tanggal->format('d M Y') }}</small>
                                </td>
                                <td><span class="badge badge-secondary">{{ $item->kategori->nama_kategori }}</span></td>
                                <td>
                                    @if($item->status == 'publish')
                                        <span class="badge badge-success">Published</span>
                                    @else
                                        <span class="badge badge-warning">Pending Verifikasi</span>
                                    @endif
                                </td>
                                <td><span class="badge badge-info">{{ $item->likes->count() }}</span></td>
                                <td>
                                    <a href="{{ route('artikel.show', $item) }}" class="btn btn-info btn-sm">Lihat</a>
                                    @if($item->status == 'draft')
                                        <a href="{{ route('siswa.artikel.edit', $item) }}" class="btn btn-warning btn-sm">Edit</a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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
    </div>

    <!-- Notifications & Tips -->
    <div class="col-xl-4 col-lg-5">
        <!-- Recent Notifications -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Notifikasi Terbaru</h6>
                <a href="{{ route('notifications.index') }}" class="btn btn-primary btn-sm">Lihat Semua</a>
            </div>
            <div class="card-body">
                @forelse($recentNotifications as $notification)
                <div class="notification-item {{ !$notification->is_read ? 'unread' : '' }} mb-3">
                    <div class="d-flex align-items-start">
                        <div class="notification-icon mr-2">
                            @if($notification->type === 'success')
                                <i class="fas fa-check-circle text-success"></i>
                            @else
                                <i class="fas fa-info-circle text-info"></i>
                            @endif
                        </div>
                        <div class="notification-content">
                            <div class="font-weight-bold">{{ $notification->title }}</div>
                            <p class="text-muted small mb-1">{{ Str::limit($notification->message, 80) }}</p>
                            <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-3">
                    <i class="fas fa-bell-slash fa-2x text-muted mb-2"></i>
                    <p class="text-muted small mb-0">Belum ada notifikasi</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Tips Card -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tips Menulis</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <i class="fas fa-pencil-alt text-primary mr-2"></i>
                    <small>Pilih judul yang menarik dan informatif</small>
                </div>
                <div class="mb-3">
                    <i class="fas fa-camera text-success mr-2"></i>
                    <small>Tambahkan foto untuk memperkuat artikel</small>
                </div>
                <div class="mb-3">
                    <i class="fas fa-language text-info mr-2"></i>
                    <small>Gunakan bahasa yang mudah dipahami</small>
                </div>
                <div class="mb-3">
                    <i class="fas fa-tags text-warning mr-2"></i>
                    <small>Pilih kategori yang sesuai dengan topik</small>
                </div>
                <div class="mb-0">
                    <i class="fas fa-clock text-danger mr-2"></i>
                    <small>Artikel akan direview sebelum dipublish</small>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.notification-item.unread {
    background-color: #e7f3ff;
    border-left: 3px solid #4e73df;
    padding: 0.5rem;
    border-radius: 0.25rem;
}

.notification-icon {
    font-size: 1.2rem;
}

.badge-counter {
    font-size: 0.7rem;
    position: absolute;
    top: -2px;
    right: -6px;
}
</style>
@endsection