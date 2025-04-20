@extends('layouts.admin')

@section('title', 'Kelola Pesanan')
@section('header', 'Kelola Pesanan')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Daftar Pesanan</h5>
        <div>
            <form action="{{ route('admin.orders.index') }}" method="GET" class="d-flex">
                <select name="status" class="form-select form-select-sm me-2" onchange="this.form.submit()">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                    <option value="ready" {{ request('status') == 'ready' ? 'selected' : '' }}>Ready</option>
                </select>
                <input type="text" name="search" class="form-control form-control-sm me-2" placeholder="Cari pesanan..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-sm btn-primary">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
    </div>
    <div class="card-body">
        @if($orders->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Pelanggan</th>
                            <th>Tipe Pesanan</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Pembayaran</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>#{{ $order->id }}</td>
                                <td>{{ $order->user->name ?? 'Pengunjung' }}</td>
                                <td>
                                    <span class="badge {{ $order->order_type == 'dine-in' ? 'bg-success' : 'bg-primary' }}">
                                        {{ $order->order_type == 'dine-in' ? 'Dine-in' : 'Take-away' }}
                                    </span>
                                </td>
                                <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                <td>
                                    <span class="badge 
                                        @if($order->status == 'pending') bg-warning 
                                        @elseif($order->status == 'processing') bg-info 
                                        @elseif($order->status == 'ready') bg-success 
                                        @endif">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td>{{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</td>
                                <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('admin.orders.detail', $order->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                {{ $orders->appends(request()->except('page'))->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-clipboard-list fa-4x text-muted mb-3"></i>
                <h5>Belum Ada Pesanan</h5>
                <p class="text-muted">Belum ada pesanan yang masuk saat ini</p>
            </div>
        @endif
    </div>
</div>
@endsection 