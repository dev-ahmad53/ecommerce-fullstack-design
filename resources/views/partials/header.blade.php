

<!-- Main Header -->
<header class="main-header">
    <div class="container header-grid">
        <!-- Mobile menu button -->
        <button id="mobileMenuBtn" class="mobile-menu-toggle" aria-label="Open Mobile Menu">
            <svg viewBox="0 0 24 24" width="24" height="24"><path fill="currentColor" d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"/></svg>
        </button>

        <!-- Logo -->
        <a href="{{ route('home') }}" class="logo-container">
            <div class="logo-icon-bg">
                <svg class="logo-icon" viewBox="0 0 24 24" width="24" height="24">
                    <path fill="currentColor" d="M19 6h-2c0-2.76-2.24-5-5-5S7 3.24 7 6H5c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zm-7-3c1.66 0 3 1.34 3 3H9c0-1.66 1.34-3 3-3zm7 17H5V8h14v12zm-7-8c-1.66 0-3-1.34-3-3H7c0 2.76 2.24 5 5 5s5-2.24 5-5h-2c0 1.66-1.34 3-3 3z"/>
                </svg>
            </div>
            <span class="logo-text">Brand</span>
        </a>

        <!-- Search bar -->
        <div class="search-bar-wrapper">
            <form id="globalSearchForm" class="search-bar-form" action="#" method="GET">
                <input type="text" id="searchInput" placeholder="Search" aria-label="Search products" autocomplete="off">
                <div class="category-dropdown-wrapper">
                    <select id="searchCategorySelect">
                        <option value="all">All category</option>
                        <option value="electronics">Electronics</option>
                        <option value="apparel">Clothes & apparel</option>
                        <option value="home">Home & kitchen</option>
                        <option value="automotive">Automobile</option>
                    </select>
                </div>
                <button type="submit" class="search-btn">Search</button>
            </form>
            <div id="searchSuggestions" class="search-suggestions-dropdown"></div>
        </div>

        <!-- Header Actions -->
        <div class="header-actions">
            <a href="#" class="action-item" id="profileBtn">
                <svg viewBox="0 0 24 24" width="20" height="20"><path fill="currentColor" d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                <span>Profile</span>
            </a>
            <a href="#" class="action-item" id="messagesBtn">
                <svg viewBox="0 0 24 24" width="20" height="20"><path fill="currentColor" d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zM6 9h12v2H6V9zm8 5H6v-2h8v2zm4-6H6V6h12v2z"/></svg>
                <span>Message</span>
            </a>
            <a href="#" class="action-item" id="wishlistBtn">
                <svg viewBox="0 0 24 24" width="20" height="20"><path fill="currentColor" d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                <span>Orders</span>
            </a>
            <a href="#" class="action-item" id="cartToggleBtn">
                <div class="cart-icon-wrapper">
                    <svg viewBox="0 0 24 24" width="20" height="20"><path fill="currentColor" d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.08-.14.12-.31.12-.48 0-.55-.45-1-1-1H5.21l-.94-2H1zm16 16c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z"/></svg>
                    <span id="cartCountBadge" class="cart-badge">0</span>
                </div>
                <span>My cart</span>
            </a>
        </div>
    </div>
</header>

<!-- Navigation Bar -->
<nav class="navigation-bar">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="nav-left d-flex align-items-center gap-4">
            <div class="all-category-dropdown position-relative">
                <button class="nav-link-all d-flex align-items-center gap-2">
                    <svg viewBox="0 0 24 24" width="18" height="18"><path fill="currentColor" d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"/></svg>
                    All category
                </button>
                <!-- <div class="dropdown-menu-custom" id="navDropdownMenu">
                    <a href="#automobiles">Automobiles</a>
                    <a href="#clothing">Clothes and wear</a>
                    <a href="#interiors">Home Interiors</a>
                    <a href="#tech">Computer and tech</a>
                    <a href="#tools">Tools, equipments</a>
                    <a href="#sports">Sports and outdoor</a>
                    <a href="#pets">Animal and pets</a>
                    <a href="#machinery">Machinery tools</a>
                </div> -->
            </div>
            <a href="#deals" class="nav-link">Hot offers</a>
            <a href="#recommended" class="nav-link">Gift boxes</a>
            <a href="#inquiry" class="nav-link">Projects</a>
            <a href="#recommended" class="nav-link">Menu item</a>
            <div class="nav-link-dropdown position-relative">
                <button class="nav-link-btn d-flex align-items-center gap-1">
                    Help
                    <svg class="dropdown-arrow" viewBox="0 0 24 24" width="12" height="12"><path fill="currentColor" d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/></svg>
                </button>
            </div>
        </div>

        <div class="nav-right d-flex align-items-center gap-4">
            <div class="nav-link-dropdown position-relative">
                <button class="nav-link-btn d-flex align-items-center gap-1" id="langSelectBtn">
                    English, USD
                    <svg class="dropdown-arrow" viewBox="0 0 24 24" width="12" height="12"><path fill="currentColor" d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/></svg>
                </button>
            </div>
            <div class="nav-link-dropdown ship-to-dropdown">
                <button class="nav-link-btn d-flex align-items-center gap-1" id="shipToBtn">
                    Ship to 
                    <span class="flag-icon de-flag"></span>
                    <svg class="dropdown-arrow" viewBox="0 0 24 24" width="12" height="12"><path fill="currentColor" d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/></svg>
                </button>
            </div>
        </div>
    </div>
</nav>

<!-- Mobile Categories Bar -->
<div class="mobile-categories-bar">
    <div class="scrollable-pills d-flex gap-2 overflow-auto">
        <a href="#all" class="category-pill active">All category</a>
        <a href="#tech" class="category-pill">Gadgets</a>
        <a href="#clothing" class="category-pill">Clothes</a>
        <a href="#interiors" class="category-pill">Accessories</a>
        <a href="#automobiles" class="category-pill">Automotive</a>
        <a href="#tools" class="category-pill">Tools</a>
    </div>
</div>