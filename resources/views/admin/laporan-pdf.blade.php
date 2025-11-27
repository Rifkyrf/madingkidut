<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan E-Mading</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            color: #333;
            font-size: 24px;
        }
        .header p {
            margin: 5px 0;
            color: #666;
        }
        .stats {
            display: table;
            width: 100%;
            margin-bottom: 30px;
        }
        .stat-item {
            display: table-cell;
            width: 25%;
            text-align: center;
            padding: 15px;
            border: 1px solid #ddd;
            background-color: #f8f9fa;
        }
        .stat-number {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }
        .stat-label {
            color: #666;
            font-size: 11px;
            text-transform: uppercase;
        }
        .section-title {
            font-size: 16px;
            font-weight: bold;
            margin: 30px 0 15px 0;
            color: #333;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f8f9fa;
            font-weight: bold;
            color: #333;
        }
        .badge {
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 10px;
            color: white;
        }
        .badge-success { background-color: #28a745; }
        .badge-secondary { background-color: #6c757d; }
        .text-muted { color: #666; }
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 15px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN E-MADING</h1>
        <p>Electronic Magazine Board</p>
        <p>Tanggal: {{ date('d F Y') }}</p>
    </div>

    <div class="stats">
        <div class="stat-item">
            <div class="stat-number">{{ $totalArtikel }}</div>
            <div class="stat-label">Total Artikel</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">{{ $artikelPublish }}</div>
            <div class="stat-label">Artikel Published</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">{{ $artikelDraft }}</div>
            <div class="stat-label">Artikel Draft</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">{{ $totalUser }}</div>
            <div class="stat-label">Total Users</div>
        </div>
    </div>

    <div class="section-title">Artikel Terbaru (Published)</div>
    
    @if($artikelTerbaru->count() > 0)
    <table>
        <thead>
            <tr>
                <th width="35%">Judul</th>
                <th width="20%">Penulis</th>
                <th width="15%">Kategori</th>
                <th width="15%">Tanggal</th>
                <th width="15%">Role</th>
            </tr>
        </thead>
        <tbody>
            @foreach($artikelTerbaru as $artikel)
            <tr>
                <td>
                    <strong>{{ Str::limit($artikel->judul, 60) }}</strong><br>
                    <span class="text-muted">{{ Str::limit($artikel->isi, 100) }}</span>
                </td>
                <td>{{ $artikel->user->name }}</td>
                <td>{{ $artikel->kategori->nama_kategori }}</td>
                <td>{{ $artikel->tanggal->format('d M Y') }}</td>
                <td>{{ ucfirst($artikel->user->role) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p style="text-align: center; color: #666; padding: 20px;">Belum ada artikel yang dipublikasi</p>
    @endif

    <div class="footer">
        <p>Laporan ini dibuat secara otomatis oleh sistem E-Mading</p>
        <p>© {{ date('Y') }} E-Mading - Electronic Magazine Board</p>
    </div>
</body>
</html>