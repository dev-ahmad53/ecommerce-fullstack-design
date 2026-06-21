@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="page-header">
        <div>
            <h1>Dashboard</h1>
            <p class="text-muted">Welcome back, {{ Auth::user()->name ?? 'Admin' }}!</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="btn-primary">
            <i class="fas fa-plus"></i> Add Product
        </a>
    </div>

    <!-- Stats -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon blue">
                <i class="fas fa-box"></i>
            </div>
            <div class="stat-info">
                <span class="stat-label">Total Products</span>
                <span class="stat-value">{{ $totalProducts ?? 0 }}</span>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon orange">
                <i class="fas fa-tags"></i>
            </div>
            <div class="stat-info">
                <span class="stat-label">Categories</span>
                <span class="stat-value">{{ $totalCategories ?? 0 }}</span>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon green">
                <i class="fas fa-dollar-sign"></i>
            </div>
            <div class="stat-info">
                <span class="stat-label">Average Price</span>
                <span class="stat-value">${{ number_format($avgPrice ?? 0, 2) }}</span>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon purple">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-info">
                <span class="stat-label">Total Users</span>
                <span class="stat-value">{{ $totalUsers ?? 0 }}</span>
            </div>
        </div>
    </div>

    <!-- Recent Products -->
    <div class="card">
        <div class="card-header">
            <h3><i class="fas fa-clock"></i> Recent Products</h3>
            <a href="{{ route('admin.products.index') }}" class="btn-sm">View All <i class="fas fa-arrow-right"></i></a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Category</th>
                            <th>Stock</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentProducts ?? [] as $p)
                        <tr>
                            <td><img src="{{ $p->image }}" alt="{{ $p->name }}" class="product-thumb"></td>
                            <td><strong>{{ $p->name }}</strong></td>
                            <td>${{ number_format($p->price, 2) }}</td>
                            <td><span class="badge">{{ $p->category }}</span></td>
                            <td>{{ $p->stock }}</td>
                            <td>{{ $p->created_at->diffForHumans() }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="6" class="text-center">No products yet</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection