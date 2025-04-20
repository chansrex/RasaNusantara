@extends('layouts.app')

@section('title', 'Pesanan Sukses')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center py-5">
                    <div class="mb-4">
                        <div class="bg-success text-white d-inline-block rounded-circle p-3 mb-3">
                            <i class="fas fa-check-circle fa-4x"></i>
                        </div>
                        <h2 class="mb-3">Pesanan Berhasil!</h2>
                        <p class="text-muted">Pesanan Anda telah berhasil dikirim dan sedang diproses.</p>
                    </div>
                    
                    <div class="alert alert-primary mb-4">
                        <div class="row align-items-center">
                            <div class="col-md-6 text-md-start">
                                <strong>Nomor Pesanan:</strong> #{{ $order->id }}
                            </div>
                            <div class="col-md-6 text-md-end">
                                <strong>Status:</strong> <span class="badge bg-warning">{{ ucfirst($order->status) }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card mb-4">
                        <div class="card-header bg-white">
                            <h5 class="card-title mb-0">Detail Pesanan</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6 text-md-start">
                                    <strong>Tipe Pesanan:</strong>
                                    <span class="badge {{ $order->order_type == 'dine-in' ? 'bg-success' : 'bg-primary' }}">
                                        {{ $order->order_type == 'dine-in' ? 'Dine-in' : 'Take-away' }}
                                    </span>
                                </div>
                                <div class="col-md-6 text-md-end">
                                    <strong>Metode Pembayaran:</strong>
                                    <span>{{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</span>
                                </div>
                            </div>
                            <div class="text-center">
                                <h4 class="text-primary mb-0">Total: Rp {{ number_format($order->total_price, 0, ',', '.') }}</h4>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-grid gap-2">
                        <a href="{{ route('self-order.order-status', $order->id) }}" class="btn btn-primary">
                            <i class="fas fa-spinner me-2"></i> Lihat Status Pesanan
                        </a>
                        <a href="{{ route('self-order.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-home me-2"></i> Kembali ke Menu
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 