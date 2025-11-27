@extends('layouts.admin')

@section('title', 'Notifikasi - E-Mading')
@section('sidebar-color', auth()->user()->role === 'admin' ? 'primary' : (auth()->user()->role === 'guru' ? 'warning' : 'info'))
@section('user-badge', auth()->user()->role === 'admin' ? 'primary' : (auth()->user()->role === 'guru' ? 'warning' : 'info'))

@section('sidebar')
@if(auth()->user()->role === 'admin')
    <!-- Admin Sidebar -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw fa-home"></i>
            <span>Halaman Utama</span>
        </a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">Management</div>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.users') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Kelola Users</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.artikel') }}">
            <i class="fas fa-fw fa-newspaper"></i>
            <span>Kelola Artikel</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.kategori') }}">
            <i class="fas fa-fw fa-tags"></i>
            <span>Kelola Kategori</span>
        </a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('notifications.index') }}">
            <i class="fas fa-fw fa-bell"></i>
            <span>Notifikasi</span>
        </a>
    </li>
@elseif(auth()->user()->role === 'guru')
    <!-- Guru Sidebar -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('guru.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw fa-home"></i>
            <span>Halaman Utama</span>
        </a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">Artikel</div>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('guru.artikel.create') }}">
            <i class="fas fa-fw fa-plus-circle"></i>
            <span>Buat Artikel</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('guru.artikel') }}">
            <i class="fas fa-fw fa-newspaper"></i>
            <span>Artikel Saya</span>
        </a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">Moderasi</div>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('guru.moderasi') }}">
            <i class="fas fa-fw fa-user-check"></i>
            <span>Moderasi Artikel</span>
        </a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('notifications.index') }}">
            <i class="fas fa-fw fa-bell"></i>
            <span>Notifikasi</span>
        </a>
    </li>
@else
    <!-- Siswa Sidebar -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('siswa.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw fa-home"></i>
            <span>Halaman Utama</span>
        </a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">Artikel</div>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('siswa.artikel.create') }}">
            <i class="fas fa-fw fa-plus-circle"></i>
            <span>Buat Artikel</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('siswa.artikel') }}">
            <i class="fas fa-fw fa-newspaper"></i>
            <span>Artikel Saya</span>
        </a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('notifications.index') }}">
            <i class="fas fa-fw fa-bell"></i>
            <span>Notifikasi</span>
        </a>
    </li>
@endif
@endsection

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Notifikasi</h1>
        @if($notifications->where('is_read', false)->count() > 0)
            <button id="markAllRead" class="btn btn-primary btn-sm">
                <i class="fas fa-check-double"></i> Tandai Semua Dibaca
            </button>
        @endif
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Semua Notifikasi</h6>
                </div>
                <div class="card-body">
                    @forelse($notifications as $notification)
                        <div class="notification-item {{ !$notification->is_read ? 'unread' : '' }}" 
                             data-id="{{ $notification->id }}">
                            <div class="d-flex align-items-start">
                                <div class="notification-icon mr-3">
                                    @if($notification->type === 'success')
                                        <i class="fas fa-check-circle text-success"></i>
                                    @else
                                        <i class="fas fa-info-circle text-info"></i>
                                    @endif
                                </div>
                                <div class="notification-content flex-grow-1">
                                    <h6 class="notification-title">{{ $notification->title }}</h6>
                                    <p class="notification-message">{{ $notification->message }}</p>
                                    <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                </div>
                                @if(!$notification->is_read)
                                    <div class="notification-actions">
                                        <button class="btn btn-sm btn-outline-primary mark-read" 
                                                data-id="{{ $notification->id }}">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-5">
                            <i class="fas fa-bell-slash fa-3x text-muted mb-3"></i>
                            <h5>Tidak ada notifikasi</h5>
                            <p class="text-muted">Notifikasi akan muncul di sini</p>
                        </div>
                    @endforelse

                    @if($notifications->hasPages())
                        <div class="d-flex justify-content-center mt-4">
                            {{ $notifications->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.notification-item {
    padding: 1rem;
    border-bottom: 1px solid #e3e6f0;
}

.notification-item.unread {
    background-color: #e7f3ff;
    border-left: 4px solid #4e73df;
}

.notification-title {
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.notification-message {
    margin-bottom: 0.5rem;
    color: #666;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.mark-read').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.dataset.id;
            fetch(`/notifications/${id}/read`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                }
            })
            .then(() => {
                document.querySelector(`[data-id="${id}"]`).classList.remove('unread');
                this.remove();
            });
        });
    });

    const markAllButton = document.getElementById('markAllRead');
    if (markAllButton) {
        markAllButton.addEventListener('click', function() {
            fetch('/notifications/read-all', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                }
            })
            .then(() => location.reload());
        });
    }
});
</script>
@endsection