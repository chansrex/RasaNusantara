@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-5">Keranjang Belanja</h1>
    
    @if(session()->has('cart') && count(session('cart')) > 0)
        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white">
                        <h5 class="card-title mb-0">Item Pesanan ({{ count(session('cart')) }})</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Menu</th>
                                        <th>Porsi</th>
                                        <th>Catatan</th>
                                        <th class="text-end">Harga</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(session('cart') as $index => $item)
                                        <tr>
                                            <td>{{ $item['name'] }}</td>
                                            <td>{{ $item['portion_size'] ?? 'Regular' }}</td>
                                            <td>
                                                <small class="text-muted">
                                                    {{ $item['custom_notes'] ?? 'Tidak ada catatan' }}
                                                </small>
                                            </td>
                                            <td class="text-end">Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                                            <td class="text-center">
                                                <form action="{{ route('self-order.remove-from-cart', $index) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="card-title mb-0">Ringkasan Pesanan</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <span>Subtotal</span>
                            <span>Rp {{ number_format(array_sum(array_column(session('cart'), 'price')), 0, ',', '.') }}</span>
                        </div>
                        
                        <div class="d-flex justify-content-between mb-3">
                            <span>Pajak (10%)</span>
                            <span>Rp {{ number_format(array_sum(array_column(session('cart'), 'price')) * 0.1, 0, ',', '.') }}</span>
                        </div>
                        
                        <hr>
                        
                        <div class="d-flex justify-content-between mb-4">
                            <span class="fw-bold">Total</span>
                            <span class="fw-bold">Rp {{ number_format(array_sum(array_column(session('cart'), 'price')) * 1.1, 0, ',', '.') }}</span>
                        </div>
                        
                        <form action="{{ route('self-order.checkout') }}" method="POST">
                            @csrf
                            
                            <div class="mb-3">
                                <label for="order_type" class="form-label">Tipe Pesanan</label>
                                <select class="form-select" id="order_type" name="order_type" required>
                                    <option value="dine-in">Dine-in</option>
                                    <option value="take-away">Take-away</option>
                                </select>
                            </div>
                            
                            <div class="mb-4">
                                <label for="payment_method" class="form-label">Metode Pembayaran</label>
                                <select class="form-select" id="payment_method" name="payment_method" required>
                                    <option value="cash">Tunai</option>
                                    <option value="credit_card">Kartu Kredit</option>
                                    <option value="debit_card">Kartu Debit</option>
                                    <option value="e-wallet">E-Wallet</option>
                                </select>
                            </div>
                            
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-check-circle me-2"></i> Bayar Sekarang
                                </button>
                                <a href="{{ route('self-order.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-utensils me-2"></i> Tambah Menu Lainnya
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="card shadow-sm">
            <div class="card-body text-center py-5">
                <i class="fas fa-shopping-cart fa-4x text-muted mb-3"></i>
                <h4>Keranjang Kosong</h4>
                <p class="text-muted">Keranjang belanja Anda masih kosong</p>
                <a href="{{ route('self-order.index') }}" class="btn btn-primary mt-3">
                    <i class="fas fa-utensils me-2"></i> Lihat Menu
                </a>
            </div>
        </div>
    @endif
</div>
@endsection 