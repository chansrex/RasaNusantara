<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan - Rasa Nusantara</title>
    
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
        
        .btn-primary {
            background-color: #fd7e14;
            border-color: #fd7e14;
        }
        
        .btn-primary:hover, .btn-primary:focus {
            background-color: #e76b00;
            border-color: #e76b00;
        }
        
        .order-card {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s;
            margin-bottom: 20px;
            border: none;
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
        <div class="row mb-4">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-0">Riwayat Pesanan</h2>
                    <p class="text-muted">Lihat semua pesanan yang pernah Anda buat</p>
                </div>
                <a href="{{ route('self-order.menu') }}" class="btn btn-primary">
                    <i class="fas fa-arrow-left me-2"></i> Kembali ke Menu
                </a>
            </div>
        </div>
        
        @if($orders->isEmpty())
            <div class="alert alert-info text-center py-5">
                <i class="fas fa-info-circle fa-3x mb-3"></i>
                <h4>Belum Ada Pesanan</h4>
                <p class="mb-0">Anda belum pernah membuat pesanan apapun.</p>
                <a href="{{ route('self-order.menu') }}" class="btn btn-primary mt-3">Mulai Pesan Sekarang</a>
            </div>
        @else
            <div class="row">
                @foreach($orders as $order)
                <div class="col-md-6">
                    <div class="card order-card">
                        <div class="card-header bg-white d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="mb-0">Pesanan #{{ $order->id }}</h5>
                                <p class="small text-muted mb-0">{{ $order->created_at->format('d M Y, H:i') }}</p>
                            </div>
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
                        
                        <div class="card-body">
                            <div class="small mb-3">
                                <i class="fas fa-money-bill-wave me-1 text-success"></i> {{ ucfirst($order->payment_method) }}
                                <span class="mx-2">|</span>
                                <i class="fas fa-utensils me-1 text-primary"></i> {{ $order->order_type == 'dine-in' ? 'Makan di Tempat' : 'Bawa Pulang' }}
                            </div>
                            
                            <h6>Item Pesanan:</h6>
                            <ul class="list-group list-group-flush mb-3">
                                @foreach($order->orderItems as $item)
                                <li class="list-group-item px-0 py-2 border-0 bg-transparent">
                                    <div class="fw-bold">{{ $item->menu->name }}</div>
                                    <div class="small text-muted">
                                        @if($item->portion_size)
                                            Porsi: {{ $item->portion_size }}
                                        @endif
                                        
                                        @if($item->custom_notes)
                                            <div>Catatan: {{ $item->custom_notes }}</div>
                                        @endif
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                            
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="fw-bold text-primary fs-5">Total: Rp {{ number_format($order->total_price, 0, ',', '.') }}</div>
                                <a href="{{ route('self-order.order-status', $order->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye me-1"></i> Detail
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="d-flex justify-content-center mt-4">
                {{ $orders->links() }}
            </div>
        @endif
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