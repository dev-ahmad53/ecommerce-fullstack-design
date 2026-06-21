<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Panel - @yield('title', 'Brand')</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <!-- Admin CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    
    @stack('styles')
</head>
<body class="admin-body">

    <!-- ========== TOP NAVBAR ========== -->
    <nav class="admin-navbar">
        <div class="navbar-container">
            <div class="navbar-brand">
                <i class="fas fa-store"></i>
                <span>Brand Admin</span>
            </div>
            <div class="navbar-actions">
                <a href="{{ route('home') }}" target="_blank" class="nav-btn">
                    <i class="fas fa-globe"></i> View Site
                </a>
                <div class="admin-profile">
                    <div class="profile-avatar">{{ substr(Auth::user()->name ?? 'A', 0, 1) }}</div>
                    <span>{{ Auth::user()->name ?? 'Admin' }}</span>
                </div>
                <form action="{{ route('admin.logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="nav-btn logout-btn">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- ========== SIDEBAR + CONTENT ========== -->
    <div class="admin-wrapper">
        <!-- Sidebar -->
        <aside class="admin-sidebar">
            <ul class="sidebar-menu">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-th-large"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                        <i class="fas fa-boxes"></i> Products
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.products.create') }}">
                        <i class="fas fa-plus-circle"></i> Add Product
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="{{ route('home') }}" target="_blank">
                        <i class="fas fa-arrow-left"></i> Back to Store
                    </a>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="admin-main">
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                    <button class="alert-close" onclick="this.parentElement.remove()">&times;</button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                    <button class="alert-close" onclick="this.parentElement.remove()">&times;</button>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <!-- Toast Container -->
    <div id="toastContainer" class="toast-container"></div>

    <!-- jQuery + Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Admin JS -->
    <script src="{{ asset('js/admin.js') }}"></script>
    
    @stack('scripts')
</body>
</html>