@extends('layouts.app')

@section('title', 'Status Pesanan')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('self-order.index') }}">Menu</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Status Pesanan #{{ $order->id }}</li>
                </ol>
            </nav>
            
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Pesanan #{{ $order->id }}</h5>
                        <span class="badge 
                            @if($order->status == 'pending') bg-warning 
                            @elseif($order->status == 'processing') bg-info 
                            @elseif($order->status == 'ready') bg-success 
                            @endif">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <p><strong>Tanggal Pesanan:</strong> {{ $order->created_at->format('d M Y, H:i') }}</p>
                            <p><strong>Tipe Pesanan:</strong> 
                                {{ $order->order_type == 'dine-in' ? 'Dine-in' : 'Take-away' }}
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
                            <p><strong>Metode Pembayaran:</strong> 
                                {{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}
                            </p>
                        </div>
                    </div>
                    
                    <div class="progress mb-4" style="height: 30px;">
                        @if($order->status == 'pending')
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" 
                                style="width: 33%;">Pesanan Diterima</div>
                        @elseif($order->status == 'processing')
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-info" 
                                style="width: 66%;">Sedang Diproses</div>
                        @elseif($order->status == 'ready')
                            <div class="progress-bar bg-success" style="width: 100%;">Siap Diambil</div>
                        @endif
                    </div>
                    
                    <h5 class="mb-3">Item Pesanan</h5>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Menu</th>
                                    <th>Porsi</th>
                                    <th>Catatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->orderItems as $item)
                                    <tr>
                                        <td>{{ $item->menu->name }}</td>
                                        <td>{{ $item->portion_size ?? 'Regular' }}</td>
                                        <td>
                                            <small class="text-muted">
                                                {{ $item->custom_notes ?? 'Tidak ada catatan' }}
                                            </small>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="alert alert-info mt-4">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <i class="fas fa-info-circle me-2"></i>
                                @if($order->status == 'pending')
                                    Pesanan Anda sedang menunggu dikonfirmasi
                                @elseif($order->status == 'processing')
                                    Pesanan Anda sedang diproses oleh dapur kami
                                @elseif($order->status == 'ready')
                                    Pesanan Anda sudah siap untuk diambil!
                                @endif
                            </div>
                            <div class="col-md-6 text-md-end">
                                <strong>Total:</strong> Rp {{ number_format($order->total_price, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center">
                <a href="{{ route('self-order.index') }}" class="btn btn-primary">
                    <i class="fas fa-utensils me-2"></i> Kembali ke Menu
                </a>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    // Auto refresh halaman setiap 30 detik untuk update status
    setTimeout(function() {
        location.reload();
    }, 30000);
</script>
@endsection 