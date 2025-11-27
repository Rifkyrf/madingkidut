@extends('layouts.admin')

@section('title', 'Kelola Kategori - E-Mading')
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
<li class="nav-item active">
    <a class="nav-link" href="{{ route('admin.kategori') }}">
        <i class="fas fa-fw fa-tags"></i>
        <span>Kelola Kategori</span>
    </a>
</li>

<!-- Nav Item - Reports -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('admin.laporan') }}">
        <i class="fas fa-fw fa-chart-bar"></i>
        <span>Laporan</span>
    </a>
</li>
@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Kelola Kategori</h1>
    <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addKategoriModal">
        <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Kategori
    </button>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Kategori</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Kategori</th>
                        <th>Jumlah Artikel</th>
                        <th>Dibuat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kategori as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>
                            <div class="font-weight-bold">{{ $item->nama_kategori }}</div>
                        </td>
                        <td>
                            <span class="badge badge-info">{{ $item->artikel_count }} artikel</span>
                        </td>
                        <td>{{ $item->created_at->format('d M Y') }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" onclick="editKategori({{ $item->id }}, '{{ $item->nama_kategori }}')">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            @if($item->artikel_count == 0)
                                <form method="POST" action="{{ route('admin.kategori.destroy', $item) }}" class="d-inline" 
                                      onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            @else
                                <button class="btn btn-secondary btn-sm" disabled title="Tidak dapat dihapus karena masih ada artikel">
                                    <i class="fas fa-lock"></i> Terkunci
                                </button>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <i class="fas fa-tags fa-3x text-muted mb-3"></i><br>
                            <strong>Belum ada kategori</strong><br>
                            <small class="text-muted">Tambah kategori pertama untuk mengorganisir artikel</small>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Kategori Modal -->
<div class="modal fade" id="addKategoriModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Kategori Baru</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('admin.kategori.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_kategori">Nama Kategori</label>
                        <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Kategori Modal -->
<div class="modal fade" id="editKategoriModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Kategori</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form method="POST" id="editKategoriForm">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_nama_kategori">Nama Kategori</label>
                        <input type="text" class="form-control" id="edit_nama_kategori" name="nama_kategori" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function editKategori(id, nama) {
    document.getElementById('edit_nama_kategori').value = nama;
    document.getElementById('editKategoriForm').action = '/admin/kategori/' + id;
    $('#editKategoriModal').modal('show');
}
</script>
@endsection