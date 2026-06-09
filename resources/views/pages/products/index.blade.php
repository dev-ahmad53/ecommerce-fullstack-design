@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush

@section('title', 'Search Results - Brand')

@section('content')
    <!-- Breadcrumbs (Desktop only) -->
    <ul class="breadcrumbs">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href="#clothing">Clothings</a></li>
        <li><a href="#mens">Men's wear</a></li>
        <li><a href="#summer">Summer clothing</a></li>
    </ul>

    <!-- Mobile Filter/Sort Row Controls -->
    <div class="mobile-filter-sort-bar">
        <button class="btn btn-white" id="mobileSortBtn">
            Sort: Newest
            <svg viewBox="0 0 24 24" width="16" height="16" style="margin-left: 4px;"><path fill="currentColor" d="M3 18h6v-2H3v2zM3 6v2h18V6H3zm0 7h12v-2H3v2z"/></svg>
        </button>
        <button class="btn btn-white" id="mobileFilterToggleBtn">
            Filter (3)
            <svg viewBox="0 0 24 24" width="16" height="16" style="margin-left: 4px;"><path fill="currentColor" d="M10 18h4v-2h-4v2zM3 6v2h18V6H3zm3 7h12v-2H6v2z"/></svg>
        </button>
        <div class="mobile-layout-toggle-group">
            <button class="btn btn-white mobile-layout-btn" id="mobileGridBtn" aria-label="Grid View">
                <svg viewBox="0 0 24 24" width="16" height="16"><path fill="currentColor" d="M4 11h5V5H4v6zm0 8h5v-6H4v6zm6 0h5v-6h-5v6zm6 0h5v-6h-5v6zm-6-8h5V5h-5v6zm6-6v6h5V5h-5z"/></svg>
            </button>
            <button class="btn btn-white mobile-layout-btn" id="mobileListBtn" aria-label="List View">
                <svg viewBox="0 0 24 24" width="16" height="16"><path fill="currentColor" d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"/></svg>
            </button>
        </div>
    </div>

    <!-- Shop Layout Grid -->
    <div class="shop-layout-grid">
        
        <!-- Sidebar Filters -->
        <aside class="shop-sidebar" id="filterSidebar">
            <div class="filter-sidebar card-box" style="padding: 20px;">
                
                <!-- Category Group -->
                <div class="filter-group">
                    <div class="filter-group-title" data-group="cat">
                        <span>Category</span>
                        <svg class="accordion-arrow" viewBox="0 0 24 24" width="16" height="16"><path fill="currentColor" d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/></svg>
                    </div>
                    <div class="filter-body" id="filter-cat">
                        <ul class="filter-options" style="gap: 8px;">
                            <li><a href="#" style="color: var(--primary-blue); font-weight: 500;">Mobile accessory</a></li>
                            <li><a href="#">Electronics</a></li>
                            <li><a href="#">Smartphones</a></li>
                            <li><a href="#">Modern tech</a></li>
                            <li><a href="#" class="filter-see-all">See all</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Brands Group -->
                <div class="filter-group">
                    <div class="filter-group-title" data-group="brands">
                        <span>Brands</span>
                        <svg class="accordion-arrow" viewBox="0 0 24 24" width="16" height="16"><path fill="currentColor" d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/></svg>
                    </div>
                    <div class="filter-body" id="filter-brands">
                        <ul class="filter-options">
                            <li><label><input type="checkbox" class="brand-filter-chk" value="Samsung"> Samsung</label></li>
                            <li><label><input type="checkbox" class="brand-filter-chk" value="Apple"> Apple</label></li>
                            <li><label><input type="checkbox" class="brand-filter-chk" value="Huawei"> Huawei</label></li>
                            <li><label><input type="checkbox" class="brand-filter-chk" value="Poco"> Poco</label></li>
                            <li><label><input type="checkbox" class="brand-filter-chk" value="Lenovo"> Lenovo</label></li>
                            <li><a href="#" class="filter-see-all">See all</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Features Group -->
                <div class="filter-group">
                    <div class="filter-group-title" data-group="features">
                        <span>Features</span>
                        <svg class="accordion-arrow" viewBox="0 0 24 24" width="16" height="16"><path fill="currentColor" d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/></svg>
                    </div>
                    <div class="filter-body" id="filter-features">
                        <ul class="filter-options">
                            <li><label><input type="checkbox" class="feature-filter-chk" value="Metallic"> Metallic</label></li>
                            <li><label><input type="checkbox" class="feature-filter-chk" value="Plastic cover"> Plastic cover</label></li>
                            <li><label><input type="checkbox" class="feature-filter-chk" value="8GB Ram"> 8GB Ram</label></li>
                            <li><label><input type="checkbox" class="feature-filter-chk" value="Super power"> Super power</label></li>
                            <li><label><input type="checkbox" class="feature-filter-chk" value="Large Memory"> Large Memory</label></li>
                            <li><label><input type="checkbox" class="feature-filter-chk" value="64GB"> 64GB</label></li>
                            <li><a href="#" class="filter-see-all">See all</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Price Range -->
                <div class="filter-group">
                    <div class="filter-group-title collapsed" data-group="price">
                        <span>Price range</span>
                        <svg class="accordion-arrow" viewBox="0 0 24 24" width="16" height="16"><path fill="currentColor" d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/></svg>
                    </div>
                    <div class="filter-body collapsed" id="filter-price" style="max-height: 0px;">
                        <div class="price-range-inputs">
                            <div class="price-inputs-row">
                                <input type="number" id="minPriceInput" placeholder="Min" min="0">
                                <span style="color: var(--text-muted);">–</span>
                                <input type="number" id="maxPriceInput" placeholder="Max" min="0">
                            </div>
                            <button class="btn btn-white btn-sm price-range-btn" id="applyPriceFilterBtn">Apply</button>
                        </div>
                    </div>
                </div>

                <!-- Condition Group -->
                <div class="filter-group">
                    <div class="filter-group-title collapsed" data-group="condition">
                        <span>Condition</span>
                        <svg class="accordion-arrow" viewBox="0 0 24 24" width="16" height="16"><path fill="currentColor" d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/></svg>
                    </div>
                    <div class="filter-body collapsed" id="filter-condition" style="max-height: 0px;">
                        <ul class="filter-options">
                            <li><label><input type="radio" name="condition" value="any" checked> Any condition</label></li>
                            <li><label><input type="radio" name="condition" value="new"> Brand new</label></li>
                            <li><label><input type="radio" name="condition" value="refurbished"> Refurbished</label></li>
                        </ul>
                    </div>
                </div>

                <!-- Ratings Group -->
                <div class="filter-group">
                    <div class="filter-group-title collapsed" data-group="ratings">
                        <span>Ratings</span>
                        <svg class="accordion-arrow" viewBox="0 0 24 24" width="16" height="16"><path fill="currentColor" d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/></svg>
                    </div>
                    <div class="filter-body collapsed" id="filter-ratings" style="max-height: 0px;">
                        <ul class="filter-options">
                            <li><label><input type="checkbox" class="rating-filter-chk" value="5"> ★★★★★ (5)</label></li>
                            <li><label><input type="checkbox" class="rating-filter-chk" value="4"> ★★★★☆ (4)</label></li>
                            <li><label><input type="checkbox" class="rating-filter-chk" value="3"> ★★★☆☆ (3)</label></li>
                        </ul>
                    </div>
                </div>

                <!-- Manufacturer Group -->
                <div class="filter-group">
                    <div class="filter-group-title collapsed" data-group="manufacturer">
                        <span>Manufacturer</span>
                        <svg class="accordion-arrow" viewBox="0 0 24 24" width="16" height="16"><path fill="currentColor" d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/></svg>
                    </div>
                    <div class="filter-body collapsed" id="filter-manufacturer" style="max-height: 0px;">
                        <ul class="filter-options">
                            <li><label><input type="checkbox"> Factory direct</label></li>
                            <li><label><input type="checkbox"> Authorized dealer</label></li>
                        </ul>
                    </div>
                </div>

            </div>
        </aside>

        <!-- Main Product Results Panel -->
        <div class="shop-main-content">
            
            <!-- Desktop Header Controls Panel -->
            <div class="shop-header-panel card-box">
                <div class="shop-header-left">
                    <span><strong id="productCount">12,911</strong> items in <strong>Mobile accessory</strong></span>
                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 13px;">
                        <input type="checkbox" style="width: 16px; height: 16px; accent-color: var(--primary-blue);" id="verifiedOnlyCheckbox"> Verified only
                    </label>
                </div>
                <div class="shop-header-right">
                    <select id="desktopSortSelect" aria-label="Sort by" style="padding: 6px; border: 1px solid var(--border-color); border-radius: var(--radius-md); background-color: var(--bg-card); cursor: pointer;">
                        <option value="featured">Featured</option>
                        <option value="price-low">Price: Low to High</option>
                        <option value="price-high">Price: High to Low</option>
                        <option value="rating">Rating</option>
                    </select>
                    <div class="layout-toggle-btns">
                        <button class="layout-btn active" id="gridLayoutBtn" aria-label="Grid View">
                            <svg viewBox="0 0 24 24" width="18" height="18"><path fill="currentColor" d="M4 11h5V5H4v6zm0 8h5v-6H4v6zm6 0h5v-6h-5v6zm6 0h5v-6h-5v6zm-6-8h5V5h-5v6zm6-6v6h5V5h-5z"/></svg>
                        </button>
                        <button class="layout-btn" id="listLayoutBtn" aria-label="List View">
                            <svg viewBox="0 0 24 24" width="18" height="18"><path fill="currentColor" d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"/></svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Active Filter Tags Row -->
            <div class="active-tags-row" id="activeTagsRow">
                <span class="clear-tags-btn" id="clearAllTagsBtn">Clear all filter</span>
            </div>

            <!-- Products Listing Container -->
            <div class="products-display-container" id="shopProductsContainer">
                <!-- Filled dynamically by products.js -->
                <div style="text-align: center; padding: 40px;">Loading products...</div>
            </div>

            <!-- Pagination Bar -->
            <div class="pagination-row">
                <select id="perPageSelect" aria-label="Items per page" style="padding: 6px; border: 1px solid var(--border-color); border-radius: var(--radius-md); background-color: var(--bg-card); cursor: pointer;">
                    <option value="10">Show 10</option>
                    <option value="20">Show 20</option>
                    <option value="50">Show 50</option>
                </select>
                <div class="pagination-controls" id="paginationControls">
                    <button class="page-btn" data-page="prev">&lt;</button>
                    <button class="page-btn active" data-page="1">1</button>
                    <button class="page-btn" data-page="2">2</button>
                    <button class="page-btn" data-page="3">3</button>
                    <button class="page-btn" data-page="next">&gt;</button>
                </div>
            </div>

        </div>
    </div>

    <!-- You may also like Section (Mobile) -->
    <section class="related-section-mobile">
        <h2 class="section-title-md" style="margin-bottom: 15px; padding: 0 10px;">You may also like</h2>
        <div class="slider-container-horizontal" id="youMayAlsoLikeContainer">
            <!-- JS will populate -->
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="newsletter-section" style="margin-top: 30px;">
        <h2 class="section-title">Subscribe on our newsletter</h2>
        <p class="newsletter-subtitle">Get daily news on upcoming offers from many suppliers all over the world</p>
        <form id="newsletterForm" class="newsletter-form">
            <div class="input-wrapper">
                <svg class="email-input-icon" viewBox="0 0 24 24" width="20" height="20"><path fill="#8b96a5" d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
                <input type="email" id="newsletterEmail" placeholder="Email" required>
            </div>
            <button type="submit" class="btn btn-blue">Subscribe</button>
        </form>
    </section>

    <!-- Mobile Filters Drawer -->
    <div id="mobileFiltersDrawer" class="mobile-sidebar-drawer" style="left: auto; right: -280px; transition: right var(--transition-slow);">
        <div class="sidebar-header" style="background-color: var(--bg-card);">
            <span style="font-weight: 700; font-size: 16px;">Filters</span>
            <button id="mobileFiltersClose" class="sidebar-close-btn">
                <svg viewBox="0 0 24 24" width="24" height="24"><path fill="currentColor" d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z"/></svg>
            </button>
        </div>
        <div class="mobile-drawer-body" style="padding: 20px; overflow-y: auto; flex: 1;" id="mobileFiltersBodyMount"></div>
        <div style="padding: 15px; border-top: 1px solid var(--border-color); background-color: var(--bg-main);">
            <button class="btn btn-blue btn-full" id="applyMobileFiltersBtn">Apply Filters</button>
        </div>
    </div>

    <!-- Mobile Sidebar Overlay -->
    <div id="mobileSidebarOverlay" class="mobile-sidebar-overlay"></div>

    <!-- Toast Container -->
    <div id="toastContainer" class="toast-container"></div>
@endsection

@push('scripts')
    <script src="{{ asset('js/products.js') }}"></script>
@endpush