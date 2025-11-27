@extends('layouts.admin')

@section('title', 'Kelola Artikel - E-Mading')
@section('sidebar-color', 'primary')
@section('user-badge', 'danger')

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
<div class="sidebar-heading">Management</div>

<!-- Nav Item - Users -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('admin.users') }}">
        <i class="fas fa-fw fa-users"></i>
        <span>Kelola User</span>
    </a>
</li>

<!-- Nav Item - Articles -->
<li class="nav-item active">
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
    <h1 class="h3 mb-0 text-gray-800">Kelola Artikel</h1>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Semua Artikel Sistem</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Penulis</th>
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
                            <div class="font-weight-bold">{{ Str::limit($item->judul, 40) }}</div>
                            <small class="text-muted">{{ Str::limit($item->isi, 60) }}</small>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img class="rounded-circle mr-2" width="30" height="30" src="https://ui-avatars.com/api/?name={{ urlencode($item->user->nama) }}&background=007bff&color=fff">
                                <div>
                                    <div class="font-weight-bold">{{ $item->user->nama }}</div>
                                    <span class="badge badge-{{ $item->user->role === 'admin' ? 'danger' : ($item->user->role === 'guru' ? 'warning' : 'info') }} badge-sm">
                                        {{ ucfirst($item->user->role) }}
                                    </span>
                                </div>
                            </div>
                        </td>
                        <td><span class="badge badge-secondary">{{ $item->kategori->nama_kategori }}</span></td>
                        <td>
                            <span class="badge badge-{{ $item->status === 'publish' ? 'success' : 'warning' }}">
                                {{ $item->status === 'publish' ? 'Publish' : 'Draft' }}
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
                                    <form method="POST" action="{{ route('artikel.approve', $item) }}" class="mb-1">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm w-100" 
                                                onclick="return confirm('Publikasikan artikel ini?')">
                                            <i class="fas fa-check"></i> Publish
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('artikel.reject', $item) }}" class="mb-1">
                                        @csrf
                                        <button type="submit" class="btn btn-warning btn-sm w-100" 
                                                onclick="return confirm('Tolak artikel ini?')">
                                            <i class="fas fa-times"></i> Tolak
                                        </button>
                                    </form>
                                @endif
                                <form method="POST" action="{{ route('artikel.destroy', $item) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm w-100" onclick="return confirm('Yakin hapus artikel ini?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
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
    </div>
</div>
@endsection