<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang - Rasa Nusantara</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        
        .register-card {
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border: none;
            overflow: hidden;
        }
        
        .register-header {
            background-color: #fd7e14;
            color: white;
            padding: 2rem;
            text-align: center;
        }
        
        .btn-primary {
            background-color: #fd7e14;
            border-color: #fd7e14;
        }
        
        .btn-primary:hover, .btn-primary:focus {
            background-color: #e76b00;
            border-color: #e76b00;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="card register-card">
                    <div class="register-header">
                        <i class="fas fa-utensils fa-3x mb-3"></i>
                        <h2 class="mb-2">Rasa Nusantara</h2>
                        <p class="mb-0">Hidangan Asli Indonesia</p>
                    </div>
                    
                    <div class="card-body p-4">
                        <h4 class="text-center mb-4">Selamat Datang!</h4>
                        
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        
                        <p class="text-center mb-4">Untuk melanjutkan, silakan lengkapi informasi berikut:</p>
                        
                        <form action="{{ route('self-order.register') }}" method="POST">
                            @csrf
                            
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                            </div>
                            
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="is_accessible_mode" name="is_accessible_mode">
                                <label class="form-check-label" for="is_accessible_mode">Aktifkan Mode Aksesibilitas</label>
                            </div>
                            
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-utensils me-2"></i> Lihat Menu
                                </button>
                                
                                <a href="{{ route('login') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-user-shield me-2"></i> Login sebagai Admin
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
                
                <div class="text-center mt-3 text-muted small">
                    &copy; {{ date('Y') }} Rasa Nusantara. All rights reserved.
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 