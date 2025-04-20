@extends('layouts.admin')

@section('title', 'Kelola Menu')
@section('header', 'Kelola Menu')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Daftar Menu</h5>
        <a href="{{ route('admin.menu.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Tambah Menu Baru
        </a>
    </div>
    <div class="card-body">
        @if($menus->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th>Deskripsi</th>
                            <th>Tanggal Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($menus as $menu)
                            <tr>
                                <td>{{ $menu->id }}</td>
                                <td>{{ $menu->name }}</td>
                                <td>Rp {{ number_format($menu->price, 0, ',', '.') }}</td>
                                <td>
                                    <span class="badge {{ $menu->available ? 'bg-success' : 'bg-danger' }}">
                                        {{ $menu->available ? 'Tersedia' : 'Tidak Tersedia' }}
                                    </span>
                                </td>
                                <td>
                                    <small class="text-muted">{{ Str::limit($menu->description, 50) }}</small>
                                </td>
                                <td>{{ $menu->created_at->format('d M Y') }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('admin.menu.edit', $menu->id) }}" class="btn btn-sm btn-info me-1">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.menu.destroy', $menu->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus menu ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                {{ $menus->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-hamburger fa-4x text-muted mb-3"></i>
                <h5>Belum Ada Menu</h5>
                <p class="text-muted">Mulai tambahkan menu-menu terbaik Anda</p>
                <a href="{{ route('admin.menu.create') }}" class="btn btn-primary mt-2">
                    <i class="fas fa-plus me-1"></i> Tambah Menu Baru
                </a>
            </div>
        @endif
    </div>
</div>
@endsection 