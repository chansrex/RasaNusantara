@extends('layouts.admin')

@section('title', 'Laporan & Analitik')
@section('header', 'Laporan & Analitik')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Statistik Pelanggan</h5>
            </div>
            <div class="card-body">
                @if($activeMember)
                    <div class="mb-4">
                        <h6 class="mb-3">Member Teraktif</h6>
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px">
                                <i class="fas fa-user"></i>
                            </div>
                            <div>
                                <h5 class="mb-0">{{ $activeMember->name }}</h5>
                                <div class="text-muted">{{ $activeMember->order_count }} pesanan</div>
                            </div>
                        </div>
                    </div>
                @endif
                
                @if($topSpender)
                    <div>
                        <h6 class="mb-3">Member Terbanyak Belanja</h6>
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px">
                                <i class="fas fa-crown"></i>
                            </div>
                            <div>
                                <h5 class="mb-0">{{ $topSpender->name }}</h5>
                                <div class="text-muted">Rp {{ number_format($topSpender->total_spent, 0, ',', '.') }}</div>
                            </div>
                        </div>
                    </div>
                @endif
                
                @if(!$activeMember && !$topSpender)
                    <div class="text-center py-5">
                        <i class="fas fa-users fa-3x text-muted mb-3"></i>
                        <p>Belum ada data statistik pelanggan</p>
                    </div>
                @endif
            </div>
        </div>
        
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Statistik Penjualan</h5>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <h6 class="mb-3">Total Pendapatan</h6>
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-info text-white d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <div>
                            <h3 class="mb-0">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
                            <div class="text-muted">Total pendapatan dari semua pesanan</div>
                        </div>
                    </div>
                </div>
                
                @if($peakOrderDay)
                    <div>
                        <h6 class="mb-3">Hari Pesanan Terbanyak</h6>
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-warning text-white d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                            <div>
                                <h5 class="mb-0">{{ \Carbon\Carbon::parse($peakOrderDay->order_date)->format('d M Y') }}</h5>
                                <div class="text-muted">{{ $peakOrderDay->order_count }} pesanan</div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Produk Terlaris</h5>
            </div>
            <div class="card-body">
                @if($topProduct)
                    <div class="d-flex align-items-center mb-4">
                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px">
                            <i class="fas fa-star"></i>
                        </div>
                        <div>
                            <h5 class="mb-0">{{ $topProduct->menu->name }}</h5>
                            <div class="text-muted">Terjual {{ $topProduct->total }} kali</div>
                        </div>
                    </div>
                    
                    <div class="progress mb-3" style="height: 30px;">
                        <div class="progress-bar bg-primary" style="width: 100%;">
                            Menu Terlaris
                        </div>
                    </div>
                @else
                    <div class="text-center py-3">
                        <i class="fas fa-utensils fa-3x text-muted mb-3"></i>
                        <p>Belum ada data produk terlaris</p>
                    </div>
                @endif
            </div>
        </div>
        
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Produk yang Perlu Dipromosikan</h5>
            </div>
            <div class="card-body">
                @if($leastOrderedProducts && $leastOrderedProducts->count() > 0)
                    <p class="text-muted mb-3">Menu-menu berikut jarang dipesan dan mungkin perlu diendorse atau dipromosikan lebih:</p>
                    
                    <ul class="list-group list-group-flush">
                        @foreach($leastOrderedProducts as $product)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-0">{{ $product->name }}</h6>
                                    <small class="text-muted">Terjual {{ $product->order_count }} kali</small>
                                </div>
                                <div>
                                    <span class="badge bg-warning rounded-pill">Perlu Promosi</span>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="text-center py-3">
                        <i class="fas fa-bullhorn fa-3x text-muted mb-3"></i>
                        <p>Belum ada data produk yang perlu dipromosikan</p>
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
                <h5 class="card-title mb-0">Grafik Penjualan</h5>
            </div>
            <div class="card-body">
                <div id="salesChart" style="height: 350px;"></div>
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
            type: 'bar',
            height: 350,
            toolbar: {
                show: false
            }
        },
        plotOptions: {
            bar: {
                borderRadius: 4,
                horizontal: false,
            }
        },
        dataLabels: {
            enabled: false
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
        }
    };

    var chart = new ApexCharts(document.querySelector("#salesChart"), options);
    chart.render();
</script>
@endsection 