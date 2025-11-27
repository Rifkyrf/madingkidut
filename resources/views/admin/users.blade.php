@extends('layouts.admin')

@section('title', 'Kelola User - E-Mading')
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
<li class="nav-item active">
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
    <h1 class="h3 mb-0 text-gray-800">Kelola User</h1>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Semua User</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Terdaftar</th>
                        <th>Artikel</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img class="rounded-circle mr-3" width="40" height="40" src="https://ui-avatars.com/api/?name={{ urlencode($user->nama) }}&background=007bff&color=fff">
                                <div>
                                    <div class="font-weight-bold">{{ $user->nama }}</div>
                                </div>
                            </div>
                        </td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <span class="badge badge-{{ $user->role === 'admin' ? 'danger' : ($user->role === 'guru' ? 'warning' : 'info') }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td>
                            <div>{{ $user->created_at->format('d M Y') }}</div>
                            <small class="text-muted">{{ $user->created_at->diffForHumans() }}</small>
                        </td>
                        <td>
                            <span class="badge badge-secondary">{{ $user->artikel->count() }} artikel</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection