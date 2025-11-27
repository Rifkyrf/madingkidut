<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daftar - E-Mading</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .register-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 100%;
            max-width: 900px;
            min-height: 600px;
            position: relative;
        }
        
        .form-section {
            padding: 60px 50px;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .brand {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .brand h1 {
            color: #667eea;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
        }
        
        .brand p {
            color: #666;
            font-size: 1.1rem;
            font-weight: 300;
        }
        
        .form-group {
            position: relative;
            margin-bottom: 20px;
        }
        
        .form-control {
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid #e1e5e9;
            border-radius: 15px;
            padding: 12px 15px 12px 45px;
            font-size: 14px;
            transition: all 0.3s ease;
            width: 100%;
        }
        
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
            background: white;
        }
        
        .form-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #667eea;
            font-size: 16px;
        }
        
        .btn-register {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 15px;
            padding: 15px 30px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s ease;
            margin-top: 20px;
        }
        
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
            color: white;
        }
        
        .info-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .info-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="2" fill="%23ffffff" opacity="0.1"/></svg>') repeat;
            animation: float 20s infinite linear;
        }
        
        @keyframes float {
            0% { transform: translateX(0) translateY(0); }
            100% { transform: translateX(-100px) translateY(-100px); }
        }
        
        .info-content {
            position: relative;
            z-index: 2;
        }
        
        .info-section h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 20px;
        }
        
        .info-section p {
            font-size: 1.2rem;
            opacity: 0.9;
            line-height: 1.6;
            margin-bottom: 30px;
        }
        
        .features {
            list-style: none;
            text-align: left;
        }
        
        .features li {
            padding: 10px 0;
            font-size: 1.1rem;
            opacity: 0.9;
        }
        
        .features i {
            margin-right: 15px;
            color: #ffd700;
        }
        
        .alert {
            border-radius: 15px;
            border: none;
            margin-bottom: 25px;
        }
        
        .home-link {
            position: absolute;
            top: 20px;
            left: 20px;
            color: white;
            text-decoration: none;
            font-size: 18px;
            padding: 10px 20px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 25px;
            transition: all 0.3s ease;
        }
        
        .home-link:hover {
            background: rgba(255, 255, 255, 0.3);
            color: white;
            transform: translateY(-2px);
        }
        
        @media (max-width: 768px) {
            .form-section, .info-section {
                padding: 40px 30px;
            }
            
            .brand h1 {
                font-size: 2rem;
            }
            
            .info-section h2 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <a href="{{ route('home') }}" class="home-link">
            <i class="fas fa-home"></i> Beranda
        </a>
        
        <div class="row g-0 h-100">
            <!-- Form Section -->
            <div class="col-lg-6">
                <div class="form-section">
                    <div class="brand">
                        <h1><i class="fas fa-newspaper"></i> E-Mading</h1>
                        <p>Daftar sebagai Siswa</p>
                    </div>
                    
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-triangle"></i>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <form method="POST" action="{{ route('register.store') }}">
                        @csrf
                        
                        <div class="form-group">
                            <i class="fas fa-user form-icon"></i>
                            <input type="text" 
                                   name="nama" 
                                   class="form-control @error('nama') is-invalid @enderror" 
                                   placeholder="Nama Lengkap"
                                   value="{{ old('nama') }}" 
                                   required 
                                   autofocus>
                        </div>
                        
                        <div class="form-group">
                            <i class="fas fa-at form-icon"></i>
                            <input type="text" 
                                   name="username" 
                                   class="form-control @error('username') is-invalid @enderror" 
                                   placeholder="Username"
                                   value="{{ old('username') }}" 
                                   required>
                        </div>
                        
                        <div class="form-group">
                            <i class="fas fa-envelope form-icon"></i>
                            <input type="email" 
                                   name="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   placeholder="Email"
                                   value="{{ old('email') }}" 
                                   required>
                        </div>
                        
                        <div class="form-group">
                            <i class="fas fa-lock form-icon"></i>
                            <input type="password" 
                                   name="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   placeholder="Password"
                                   required>
                        </div>
                        
                        <div class="form-group">
                            <i class="fas fa-lock form-icon"></i>
                            <input type="password" 
                                   name="password_confirmation" 
                                   class="form-control" 
                                   placeholder="Konfirmasi Password"
                                   required>
                        </div>
                        
                        <button type="submit" class="btn btn-register">
                            <i class="fas fa-user-plus"></i> Daftar
                        </button>
                    </form>
                    
                    <div class="text-center mt-4">
                        <p class="text-muted">Sudah punya akun? <a href="{{ route('login') }}" class="text-decoration-none">Masuk di sini</a></p>
                    </div>
                </div>
            </div>
            
            <!-- Info Section -->
            <div class="col-lg-6">
                <div class="info-section">
                    <div class="info-content">
                        <h2>Bergabung dengan E-Mading</h2>
                        <p>Daftar sebagai siswa dan mulai berbagi artikel, ide, dan kreativitas Anda</p>
                        
                        <ul class="features">
                            <li><i class="fas fa-pen"></i> Tulis dan publikasikan artikel</li>
                            <li><i class="fas fa-users"></i> Berinteraksi dengan komunitas sekolah</li>
                            <li><i class="fas fa-heart"></i> Like dan komentar artikel</li>
                            <li><i class="fas fa-bell"></i> Dapatkan notifikasi artikel disetujui</li>
                            <li><i class="fas fa-graduation-cap"></i> Khusus untuk siswa</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>