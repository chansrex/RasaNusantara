<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Rasa Nusantara</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
            display: flex;
            align-items: center;
            min-height: 100vh;
        }
        
        .login-card {
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            border: none;
        }
        
        .login-header {
            background-color: #fd7e14;
            color: white;
            padding: 2rem;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
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
        
        .form-floating .form-control:focus {
            border-color: #fd7e14;
            box-shadow: 0 0 0 0.25rem rgba(253, 126, 20, 0.25);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card login-card">
                    <div class="login-header">
                        <i class="fas fa-utensils fa-3x mb-3"></i>
                        <h3 class="mb-0">Rasa Nusantara</h3>
                        <p class="mb-0">Admin Dashboard</p>
                    </div>
                    
                    <div class="card-body p-4">
                        <h5 class="card-title text-center mb-4">Login Admin</h5>
                        
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" value="{{ old('email') }}" required>
                                <label for="email">Email</label>
                            </div>
                            
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                <label for="password">Password</label>
                            </div>
                            
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="remember" name="remember">
                                <label class="form-check-label" for="remember">
                                    Ingat Saya
                                </label>
                            </div>
                            
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-sign-in-alt me-2"></i> Login
                                </button>
                            </div>
                        </form>
                        
                        <div class="mt-4 text-center">
                            <a href="{{ route('self-order.index') }}" class="text-decoration-none">
                                <i class="fas fa-utensils me-1"></i> Kembali ke Menu Self-Order
                            </a>
                        </div>
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