@extends('layouts.app')

@section('title', 'Menu Kami')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-5">Menu Kami</h1>
    
    <div class="row">
        @forelse($menus as $menu)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="https://source.unsplash.com/600x400/?food,{{ urlencode($menu->name) }}" class="card-img-top" alt="{{ $menu->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $menu->name }}</h5>
                        <p class="card-text text-truncate">{{ $menu->description }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold text-primary">Rp {{ number_format($menu->price, 0, ',', '.') }}</span>
                            <a href="{{ route('self-order.menu-detail', $menu->id) }}" class="btn btn-sm btn-primary">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i> Belum ada menu tersedia saat ini.
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection 