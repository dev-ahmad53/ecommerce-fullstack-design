<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Brand - The leading global e-commerce marketplace for electronics, home and outdoor products, clothing, and machinery.">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Brand - Global E-commerce Marketplace')</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Page Specific CSS -->
    @stack('styles')
</head>
<body>

    @include('partials.header')

    <main class="main-content">
        <div class="container">
            @yield('content')
        </div>
    </main>

    @include('partials.footer')

    <!-- Cart Drawer Elements -->
    <div id="cartDrawer" class="cart-drawer">
        <div class="cart-drawer-header">
            <h3 class="cart-drawer-title">Your Cart (<span id="cartDrawerCount">0</span>)</h3>
            <button id="cartCloseBtn" class="cart-drawer-close" aria-label="Close cart">
                <svg viewBox="0 0 24 24" width="24" height="24"><path fill="currentColor" d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z"/></svg>
            </button>
        </div>
        <div class="cart-drawer-body" id="cartDrawerBody">
            <div class="cart-empty-state" id="cartEmptyState">
                <svg viewBox="0 0 24 24" width="64" height="64"><path fill="#bdc3c7" d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.08-.14.12-.31.12-.48 0-.55-.45-1-1-1H5.21l-.94-2H1zm16 16c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z"/></svg>
                <p>Your cart is empty</p>
            </div>
            <div class="cart-items-list" id="cartItemsList" style="display: none;"></div>
        </div>
        <div class="cart-drawer-footer" id="cartDrawerFooter" style="display: none;">
            <div class="cart-subtotal-row">
                <span>Subtotal</span>
                <span class="subtotal-val" id="cartSubtotalValue">$0.00</span>
            </div>
            <button class="btn btn-blue btn-full checkout-btn" id="checkoutBtn">Proceed to Checkout</button>
        </div>
    </div>
    <div id="cartOverlay" class="cart-drawer-overlay"></div>

    <!-- Mobile Sidebar -->
    <div id="mobileSidebar" class="mobile-sidebar-drawer">
        <div class="sidebar-header">
            <div class="sidebar-user-info">
                <div class="user-avatar-sm">
                    <svg viewBox="0 0 24 24" width="20" height="20"><path fill="#ffffff" d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                </div>
                <span>Sign in | Register</span>
            </div>
            <button id="mobileSidebarClose" class="sidebar-close-btn">
                <svg viewBox="0 0 24 24" width="24" height="24"><path fill="currentColor" d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z"/></svg>
            </button>
        </div>
        <ul class="mobile-sidebar-nav">
            <li><a href="{{ route('home') }}" class="active"><svg viewBox="0 0 24 24" width="18" height="18"><path fill="currentColor" d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/></svg> Home</a></li>
            <li><a href="#automobiles">Automobiles</a></li>
            <li><a href="#clothing">Clothes and wear</a></li>
            <li><a href="#interiors">Home Interiors</a></li>
            <li><a href="#tech">Computer and tech</a></li>
            <li><a href="#tools">Tools, equipments</a></li>
            <li><a href="#sports">Sports and outdoor</a></li>
            <li><a href="#pets">Animal and pets</a></li>
            <li><a href="#machinery">Machinery tools</a></li>
            <li class="divider"></li>
            <li><a href="#deals">Hot offers</a></li>
            <li><a href="#recommended">Gift boxes</a></li>
            <li><a href="#inquiry">Projects</a></li>
            <li class="divider"></li>
            <li><a href="#">Help Center</a></li>
            <li><a href="#">Contact Us</a></li>
        </ul>
    </div>
    <div id="mobileSidebarOverlay" class="mobile-sidebar-overlay"></div>

    <!-- Product Detail Modal -->
    <div id="productDetailModal" class="modal-overlay">
        <div class="modal-container">
            <button class="modal-close-btn" id="modalCloseBtn">
                <svg viewBox="0 0 24 24" width="24" height="24"><path fill="currentColor" d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z"/></svg>
            </button>
            <div class="modal-content-grid" id="modalDetailsContent"></div>
        </div>
    </div>

    <div id="toastContainer" class="toast-container"></div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Page Specific JS -->
    @stack('scripts')
</body>
</html>