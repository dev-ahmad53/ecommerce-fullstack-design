@extends('admin.layouts.app')

@section('title', 'Products')

@section('content')
    <div class="page-header">
        <div>
            <h1><i class="fas fa-boxes"></i> Products</h1>
            <p class="text-muted">Manage your product catalog</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="btn-primary">
            <i class="fas fa-plus"></i> Add Product
        </a>
    </div>

    <!-- Search Bar -->
    <div class="search-bar">
        <i class="fas fa-search"></i>
        <input type="text" id="searchProducts" placeholder="Search products by name, category..." class="search-input">
    </div>

    <!-- Stats Summary -->
    <div class="stats-grid" style="margin-bottom:24px;">
        <div class="stat-card" style="padding:12px 20px;">
            <div class="stat-icon blue" style="width:36px;height:36px;font-size:16px;">
                <i class="fas fa-box"></i>
            </div>
            <div class="stat-info">
                <span class="stat-label">Total Products</span>
                <span class="stat-value" style="font-size:18px;">{{ $products->count() }}</span>
            </div>
        </div>
        <div class="stat-card" style="padding:12px 20px;">
            <div class="stat-icon orange" style="width:36px;height:36px;font-size:16px;">
                <i class="fas fa-tags"></i>
            </div>
            <div class="stat-info">
                <span class="stat-label">Categories</span>
                <span class="stat-value" style="font-size:18px;">{{ $products->pluck('category')->unique()->count() }}</span>
            </div>
        </div>
        <div class="stat-card" style="padding:12px 20px;">
            <div class="stat-icon green" style="width:36px;height:36px;font-size:16px;">
                <i class="fas fa-dollar-sign"></i>
            </div>
            <div class="stat-info">
                <span class="stat-label">Avg Price</span>
                <span class="stat-value" style="font-size:18px;">${{ number_format($products->avg('price') ?? 0, 2) }}</span>
            </div>
        </div>
        <div class="stat-card" style="padding:12px 20px;">
            <div class="stat-icon purple" style="width:36px;height:36px;font-size:16px;">
                <i class="fas fa-cubes"></i>
            </div>
            <div class="stat-info">
                <span class="stat-label">Total Stock</span>
                <span class="stat-value" style="font-size:18px;">{{ $products->sum('stock') }}</span>
            </div>
        </div>
    </div>

    <!-- Products Table -->
    <div class="card">
        <div class="card-body" style="padding:0;">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width:50px;">#</th>
                            <th style="width:70px;">Image</th>
                            <th>Name</th>
                            <th style="width:100px;">Price</th>
                            <th style="width:120px;">Category</th>
                            <th style="width:80px;">Stock</th>
                            <th style="width:140px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="productsTableBody">
                        @forelse($products as $p)
                        <tr>
                            <td>{{ $p->id }}</td>
                            <td>
                                @if($p->image)
                                    <img src="{{ $p->image }}" alt="{{ $p->name }}" class="product-thumb">
                                @else
                                    <div class="no-image-placeholder">
                                        <i class="fas fa-image"></i>
                                    </div>
                                @endif
                            </td>
                            <td><strong>{{ $p->name }}</strong></td>
                            <td>${{ number_format($p->price, 2) }}</td>
                            <td><span class="badge">{{ $p->category ?? 'Uncategorized' }}</span></td>
                            <td>
                                <span class="stock-badge {{ $p->stock > 10 ? 'in-stock' : ($p->stock > 0 ? 'low-stock' : 'out-of-stock') }}">
                                    {{ $p->stock }}
                                </span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('admin.products.edit', $p->id) }}" class="btn-edit" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $p->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete" onclick="return confirm('Are you sure you want to delete "{{ $p->name }}"?')" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" style="text-align:center;padding:50px 20px;">
                                <i class="fas fa-box-open" style="font-size:48px;color:#bdc3c7;display:block;margin-bottom:15px;"></i>
                                <p style="color:#6c757d;font-size:16px;margin-bottom:15px;">No products found in your catalog</p>
                                <a href="{{ route('admin.products.create') }}" class="btn-primary">
                                    <i class="fas fa-plus"></i> Add Your First Product
                                </a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Search functionality
        const searchInput = document.getElementById('searchProducts');
        if (searchInput) {
            searchInput.addEventListener('keyup', function() {
                const query = this.value.toLowerCase().trim();
                const rows = document.querySelectorAll('#productsTableBody tr');
                let visibleCount = 0;
                
                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    if (text.includes(query)) {
                        row.style.display = '';
                        visibleCount++;
                    } else {
                        row.style.display = 'none';
                    }
                });

                // Show message if no results
                const noResultRow = document.querySelector('#productsTableBody tr.no-result');
                if (visibleCount === 0 && rows.length > 0) {
                    if (!noResultRow) {
                        const tr = document.createElement('tr');
                        tr.className = 'no-result';
                        tr.innerHTML = `<td colspan="7" style="text-align:center;padding:30px;color:#6c757d;">
                            <i class="fas fa-search" style="font-size:24px;display:block;margin-bottom:10px;"></i>
                            No products found matching "<strong>${query}</strong>"
                        </td>`;
                        document.querySelector('#productsTableBody').appendChild(tr);
                    }
                } else {
                    if (noResultRow) {
                        noResultRow.remove();
                    }
                }
            });
        }
    });
</script>
@endpush