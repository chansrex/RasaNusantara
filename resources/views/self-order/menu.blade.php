<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Rasa Nusantara</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }
        
        .navbar-brand {
            font-weight: 700;
        }
        
        .menu-card {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s;
            height: 100%;
        }
        
        .menu-card:hover {
            transform: translateY(-5px);
        }
        
        .menu-img {
            height: 180px;
            object-fit: cover;
        }
        
        .menu-category {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
        }
        
        .menu-price {
            font-size: 1.1rem;
            font-weight: 600;
            color: #fd7e14;
        }
        
        .btn-primary {
            background-color: #fd7e14;
            border-color: #fd7e14;
        }
        
        .btn-primary:hover, .btn-primary:focus {
            background-color: #e76b00;
            border-color: #e76b00;
        }
        
        .cart-icon {
            position: relative;
        }
        
        .cart-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: #fd7e14;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .order-status {
            border-left: 4px solid #fd7e14;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
        }
        
        .status-badge {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        .status-pending {
            background-color: #ffc107;
            color: #212529;
        }
        
        .status-processing {
            background-color: #0dcaf0;
            color: #212529;
        }
        
        .status-ready {
            background-color: #198754;
            color: white;
        }
        
        .status-completed {
            background-color: #6c757d;
            color: white;
        }
        
        .status-cancelled {
            background-color: #dc3545;
            color: white;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('self-order.menu') }}">
                <i class="fas fa-utensils me-2 text-primary"></i>
                Rasa Nusantara
            </a>
            
            <div class="d-flex align-items-center">
                <div class="me-2">
                    <span class="fw-bold">{{ Auth::user()->name }}</span>
                </div>
                
                <a href="{{ route('self-order.cart') }}" class="btn btn-outline-primary position-relative me-2">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        {{ session('cart') ? count(session('cart')) : 0 }}
                    </span>
                </a>
                
                <a href="{{ route('self-order.order-history') }}" class="btn btn-sm btn-outline-secondary me-2">
                    <i class="fas fa-history"></i>
                </a>
                
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </form>
            </div>
        </div>
    </nav>
    
    <div class="container py-5">
        <!-- Active Orders Section -->
        @if(count($activeOrders) > 0)
        <div class="row mb-5">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white">
                        <h5 class="mb-0"><i class="fas fa-receipt me-2 text-primary"></i> Pesanan Aktif Anda</h5>
                    </div>
                    <div class="card-body">
                        @foreach($activeOrders as $order)
                        <div class="order-status bg-light">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div>
                                    <span class="fw-bold">Pesanan #{{ $order->id }}</span>
                                    <span class="text-muted ms-2 small">{{ $order->created_at->format('d M Y, H:i') }}</span>
                                </div>
                                <div>
                                    @php
                                        $statusClass = 'status-pending';
                                        if($order->status == 'processing') {
                                            $statusClass = 'status-processing';
                                        } elseif($order->status == 'ready') {
                                            $statusClass = 'status-ready';
                                        } elseif($order->status == 'completed') {
                                            $statusClass = 'status-completed';
                                        } elseif($order->status == 'cancelled') {
                                            $statusClass = 'status-cancelled';
                                        }
                                    @endphp
                                    <span class="status-badge {{ $statusClass }}">
                                        @if($order->status == 'pending')
                                            Menunggu Konfirmasi
                                        @elseif($order->status == 'processing')
                                            Sedang Diproses
                                        @elseif($order->status == 'ready')
                                            Siap Diambil
                                        @elseif($order->status == 'completed')
                                            Selesai
                                        @elseif($order->status == 'cancelled')
                                            Dibatalkan
                                        @endif
                                    </span>
                                </div>
                            </div>
                            
                            <div class="small mb-2">
                                <i class="fas fa-money-bill-wave me-1 text-success"></i> {{ ucfirst($order->payment_method) }}
                                <span class="mx-2">|</span>
                                <i class="fas fa-utensils me-1 text-primary"></i> {{ $order->order_type == 'dine-in' ? 'Makan di Tempat' : 'Bawa Pulang' }}
                            </div>
                            
                            <div class="row mb-2">
                                <div class="col-12">
                                    <div class="small fw-bold mb-1">Item Pesanan:</div>
                                    <ul class="list-unstyled ms-1 small">
                                        @foreach($order->orderItems as $item)
                                        <li>
                                            <i class="fas fa-check-circle me-1 text-success"></i>
                                            {{ $item->menu->name }}
                                            @if($item->custom_notes)
                                                <span class="text-muted">- {{ $item->custom_notes }}</span>
                                            @endif
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="fw-bold text-primary">Total: Rp {{ number_format($order->total_price, 0, ',', '.') }}</div>
                                <a href="{{ route('self-order.order-status', $order->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye me-1"></i> Detail Pesanan
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endif
        
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="mb-0">Menu Kami</h2>
                <p class="text-muted">Nikmati berbagai pilihan hidangan asli Indonesia</p>
            </div>
        </div>
        
        <!-- Filter Categories -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex flex-wrap gap-2">
                    <button class="btn btn-sm btn-primary active">Semua</button>
                    <button class="btn btn-sm btn-outline-secondary">Makanan Utama</button>
                    <button class="btn btn-sm btn-outline-secondary">Minuman</button>
                    <button class="btn btn-sm btn-outline-secondary">Camilan</button>
                    <button class="btn btn-sm btn-outline-secondary">Pencuci Mulut</button>
                </div>
            </div>
        </div>
        
        <!-- Menu Items -->
        <div class="row g-4">
            @foreach($menus as $menu)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card menu-card">
                    <div class="position-relative">
                        <img src="{{ asset('storage/' . $menu->image) }}" class="card-img-top menu-img" alt="{{ $menu->name }}">
                        <div class="menu-category">{{ $menu->category }}</div>
                    </div>
                    
                    <div class="card-body">
                        <h5 class="card-title">{{ $menu->name }}</h5>
                        <p class="card-text small text-muted">{{ Str::limit($menu->description, 60) }}</p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <span class="menu-price">Rp {{ number_format($menu->price, 0, ',', '.') }}</span>
                            <a href="{{ route('self-order.menu-detail', $menu->id) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-plus me-1"></i> Detail
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    
    <!-- Footer -->
    <footer class="bg-light py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-0">&copy; {{ date('Y') }} Rasa Nusantara. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="mb-0 text-muted">Jl. Kuliner Nusantara No. 123, Jakarta</p>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 