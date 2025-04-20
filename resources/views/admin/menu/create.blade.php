@extends('layouts.admin')

@section('title', 'Tambah Menu Baru')
@section('header', 'Tambah Menu Baru')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Form Tambah Menu</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.menu.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label for="name" class="form-label">Nama Menu <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="price" class="form-label">Harga <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text">Rp</span>
                    <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}" min="0" step="1000" required>
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">Deskripsikan menu ini dengan singkat dan menarik</small>
            </div>
            
            <div class="mb-3">
                <label for="nutrition_info" class="form-label">Informasi Nutrisi</label>
                <textarea class="form-control @error('nutrition_info') is-invalid @enderror" id="nutrition_info" name="nutrition_info" rows="3">{{ old('nutrition_info') }}</textarea>
                @error('nutrition_info')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">Berikan informasi kandungan nutrisi jika ada</small>
            </div>
            
            <div class="mb-4">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="available" name="available" value="1" {{ old('available', '1') == '1' ? 'checked' : '' }}>
                    <label class="form-check-label" for="available">Tersedia</label>
                </div>
                <small class="text-muted">Jika dicentang, menu ini akan ditampilkan di aplikasi self-order</small>
            </div>
            
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.menu.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Simpan Menu
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 