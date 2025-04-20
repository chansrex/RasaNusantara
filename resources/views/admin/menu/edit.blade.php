@extends('layouts.admin')

@section('title', 'Edit Menu')
@section('header', 'Edit Menu')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Form Edit Menu</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.menu.update', $menu->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="name" class="form-label">Nama Menu <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $menu->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="price" class="form-label">Harga <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text">Rp</span>
                    <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price', $menu->price) }}" min="0" step="1000" required>
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $menu->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">Deskripsikan menu ini dengan singkat dan menarik</small>
            </div>
            
            <div class="mb-3">
                <label for="nutrition_info" class="form-label">Informasi Nutrisi</label>
                <textarea class="form-control @error('nutrition_info') is-invalid @enderror" id="nutrition_info" name="nutrition_info" rows="3">{{ old('nutrition_info', $menu->nutrition_info) }}</textarea>
                @error('nutrition_info')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">Berikan informasi kandungan nutrisi jika ada</small>
            </div>
            
            <div class="mb-4">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="available" name="available" value="1" {{ old('available', $menu->available) ? 'checked' : '' }}>
                    <label class="form-check-label" for="available">Tersedia</label>
                </div>
                <small class="text-muted">Jika dicentang, menu ini akan ditampilkan di aplikasi self-order</small>
            </div>
            
            <div class="d-flex justify-content-between gap-2">
                <a href="{{ route('admin.menu.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
                <div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Simpan Perubahan
                    </button>
                    <button type="button" class="btn btn-danger ms-2" data-bs-toggle="modal" data-bs-target="#deleteModal">
                        <i class="fas fa-trash me-1"></i> Hapus Menu
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus menu <strong>{{ $menu->name }}</strong>? Tindakan ini tidak dapat dibatalkan.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form action="{{ route('admin.menu.destroy', $menu->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 