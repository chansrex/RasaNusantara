@extends('layouts.admin')

@section('title', 'Detail Pesanan')
@section('header', 'Detail Pesanan #' . $order->id)

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Item Pesanan</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
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
                                    <td>
                                        <div class="fw-bold">{{ $item->menu->name }}</div>
                                        <div class="text-muted small">Rp {{ number_format($item->menu->price, 0, ',', '.') }}</div>
                                    </td>
                                    <td>{{ $item->portion_size ?? 'Regular' }}</td>
                                    <td>{{ $item->custom_notes ?? 'Tidak ada catatan' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Informasi Pesanan</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label text-muted">ID Pesanan</label>
                    <div class="fw-bold">#{{ $order->id }}</div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label text-muted">Pelanggan</label>
                    <div class="fw-bold">{{ $order->user->name ?? 'Pengunjung' }}</div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label text-muted">Tipe Pesanan</label>
                    <div>
                        <span class="badge {{ $order->order_type == 'dine-in' ? 'bg-success' : 'bg-primary' }}">
                            {{ $order->order_type == 'dine-in' ? 'Dine-in' : 'Take-away' }}
                        </span>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label text-muted">Metode Pembayaran</label>
                    <div class="fw-bold">{{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label text-muted">Tanggal Pesanan</label>
                    <div class="fw-bold">{{ $order->created_at->format('d M Y, H:i') }}</div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label text-muted">Total Harga</label>
                    <div class="fw-bold fs-4">Rp {{ number_format($order->total_price, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>
        
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Update Status</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="status" class="form-label">Status Pesanan</label>
                        <select class="form-select" id="status" name="status">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="ready" {{ $order->status == 'ready' ? 'selected' : '' }}>Ready</option>
                        </select>
                    </div>
                    
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Update Status
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="text-end mt-4">
    <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar Pesanan
    </a>
</div>
@endsection 