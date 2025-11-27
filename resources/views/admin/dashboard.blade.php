@extends('layouts.admin')

@section('title', 'Admin Dashboard - E-Mading')
@section('sidebar-color', 'primary')
@section('user-badge', 'danger')

@section('sidebar')
<!-- Nav Item - Dashboard -->
<li class="nav-item active">
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
<div class="sidebar-heading">Management</div>

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

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">Reports</div>

<!-- Nav Item - Reports -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('admin.laporan') }}">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>Laporan</span>
    </a>
</li>
@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard Admin</h1>
</div>

<!-- Content Row -->
<div class="row">
    <!-- Total Articles Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Artikel</div>
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
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Menunggu Approval</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $artikelDraft }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clock fa-2x text-gray-300"></i>
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

    <!-- Total Users Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total User</div>
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
    <!-- Pending Articles -->
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Artikel Menunggu Approval</h6>
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
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($artikelPending as $item)
                            <tr>
                                <td>
                                    <strong>{{ Str::limit($item->judul, 40) }}</strong><br>
                                    <small class="text-muted">{{ Str::limit($item->isi, 60) }}</small>
                                </td>
                                <td>
                                    {{ $item->user->nama }}<br>
                                    <span class="badge badge-{{ $item->user->role === 'guru' ? 'warning' : 'info' }}">{{ ucfirst($item->user->role) }}</span>
                                </td>
                                <td><span class="badge badge-secondary">{{ $item->kategori->nama_kategori }}</span></td>
                                <td>{{ $item->tanggal->format('d M Y') }}</td>
                                <td>
                                    <a href="{{ route('artikel.show', $item) }}" class="btn btn-info btn-sm">Lihat</a>
                                    <form method="POST" action="{{ route('artikel.approve', $item) }}" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                    </form>
                                    <form method="POST" action="{{ route('artikel.destroy', $item) }}" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">
                                    <i class="fas fa-check-circle fa-3x text-success mb-3"></i><br>
                                    <strong>Tidak ada artikel yang menunggu approval</strong><br>
                                    <small class="text-muted">Semua artikel sudah dimoderasi</small>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Users -->
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">User Terbaru</h6>
            </div>
            <div class="card-body">
                @forelse($userTerbaru as $user)
                <div class="d-flex align-items-center mb-3">
                    <div class="mr-3">
                        <img class="rounded-circle" width="40" height="40" src="https://ui-avatars.com/api/?name={{ urlencode($user->nama) }}&background=007bff&color=fff">
                    </div>
                    <div class="flex-grow-1">
                        <div class="font-weight-bold">{{ $user->nama }}</div>
                        <div class="small">
                            <span class="badge badge-{{ $user->role === 'admin' ? 'danger' : ($user->role === 'guru' ? 'warning' : 'info') }}">{{ ucfirst($user->role) }}</span>
                            <span class="text-muted ml-2">{{ $user->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="small text-muted">{{ $user->artikel->count() }} artikel</div>
                    </div>
                </div>
                @empty
                <div class="text-center">
                    <i class="fas fa-users fa-3x text-muted mb-3"></i><br>
                    <strong>Belum ada user baru</strong>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection