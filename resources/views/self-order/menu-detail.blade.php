@extends('layouts.app')

@section('title', $menu->name)

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-6 mb-4">
            <img src="https://source.unsplash.com/800x600/?food,{{ urlencode($menu->name) }}" 
                class="img-fluid rounded shadow" alt="{{ $menu->name }}">
        </div>
        <div class="col-md-6">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('self-order.index') }}">Menu</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $menu->name }}</li>
                </ol>
            </nav>
            
            <h1>{{ $menu->name }}</h1>
            <h4 class="text-primary mb-4">Rp {{ number_format($menu->price, 0, ',', '.') }}</h4>
            
            <div class="mb-4">
                <h5>Deskripsi</h5>
                <p>{{ $menu->description ?: 'Tidak ada deskripsi tersedia.' }}</p>
            </div>
            
            @if($menu->nutrition_info)
            <div class="mb-4">
                <h5>Informasi Nutrisi</h5>
                <p>{{ $menu->nutrition_info }}</p>
            </div>
            @endif
            
            @if($menu->ingredients->count() > 0)
            <div class="mb-4">
                <h5>Bahan-bahan</h5>
                <ul class="list-group">
                    @foreach($menu->ingredients as $ingredient)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $ingredient->name }}
                        <span class="badge bg-primary rounded-pill">{{ $ingredient->pivot->quantity_required }} {{ $ingredient->unit }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif
            
            <form action="{{ route('self-order.add-to-cart') }}" method="POST" class="mt-4">
                @csrf
                <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                
                <div class="mb-3">
                    <label for="portion_size" class="form-label">Ukuran Porsi</label>
                    <select class="form-select" id="portion_size" name="portion_size">
                        <option value="regular">Regular</option>
                        <option value="large">Large (+Rp 5.000)</option>
                        <option value="small">Small (-Rp 3.000)</option>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="custom_notes" class="form-label">Catatan Khusus</label>
                    <textarea class="form-control" id="custom_notes" name="custom_notes" rows="3" placeholder="Contoh: Tidak pedas, tanpa bawang, dll."></textarea>
                </div>
                
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-cart-plus me-2"></i> Tambahkan ke Keranjang
                    </button>
                    <a href="{{ route('self-order.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i> Kembali ke Menu
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 