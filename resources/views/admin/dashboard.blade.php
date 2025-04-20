@extends('layouts.admin')

@section('title', 'Dashboard')
@section('header', 'Dashboard')

@section('content')
<div class="row">
    <!-- Stat Cards -->
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-body d-flex align-items-center">
                <div class="dashboard-card-icon">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1">Total Pesanan</h6>
                    <h3 class="mb-0">{{ $totalOrders }}</h3>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-body d-flex align-items-center">
                <div class="dashboard-card-icon">
                    <i class="fas fa-utensils"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1">Total Menu</h6>
                    <h3 class="mb-0">{{ $totalMenus }}</h3>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-body d-flex align-items-center">
                <div class="dashboard-card-icon">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1">Total Pendapatan</h6>
                    <h3 class="mb-0">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Charts -->
<div class="row mt-4">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Pesanan Terbaru</h5>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-primary">
                    Lihat Semua
                </a>
            </div>
            <div class="card-body">
                @if($recentOrders->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Pelanggan</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentOrders as $order)
                                    <tr>
                                        <td>#{{ $order->id }}</td>
                                        <td>{{ $order->user->name ?? 'Pengunjung' }}</td>
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
                                        <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                                        <td>
                                            <a href="{{ route('admin.orders.detail', $order->id) }}" class="btn btn-sm btn-outline-secondary">
                                                Detail
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-clipboard-list fa-3x text-muted mb-3"></i>
                        <p>Belum ada pesanan</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Produk Terlaris</h5>
            </div>
            <div class="card-body">
                @if($topProducts->count() > 0)
                    <ul class="list-group list-group-flush">
                        @foreach($topProducts as $product)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-0">{{ $product->menu->name }}</h6>
                                    <small class="text-muted">Rp {{ number_format($product->menu->price, 0, ',', '.') }}</small>
                                </div>
                                <span class="badge bg-primary rounded-pill">{{ $product->total }}x</span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-hamburger fa-3x text-muted mb-3"></i>
                        <p>Belum ada data produk terlaris</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Statistik Penjualan</h5>
            </div>
            <div class="card-body">
                <div id="salesChart" style="height: 300px;"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Sample data for chart - in a real application, get this from the backend
    var options = {
        series: [{
            name: 'Penjualan',
            data: [30, 40, 35, 50, 49, 60, 70, 91, 125, 150, 180, 210]
        }],
        chart: {
            type: 'area',
            height: 300,
            toolbar: {
                show: false
            }
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth',
            width: 2
        },
        colors: ['#fd7e14'],
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return "Rp " + val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
                }
            }
        },
        fill: {
            type: 'gradient',
            gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.7,
                opacityTo: 0.3,
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#salesChart"), options);
    chart.render();
</script>
@endsection 