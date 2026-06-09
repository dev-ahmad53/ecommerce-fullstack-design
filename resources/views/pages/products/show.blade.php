@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush

@section('title', 'Product Details - Brand')

@section('content')
    <!-- Breadcrumbs -->
    <ul class="breadcrumbs">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href="{{ route('products.index') }}">Products</a></li>
        <li><a href="#">Product Detail</a></li>
    </ul>

    <!-- Product Main Details Grid -->
    <div class="product-main-grid">
        
        <!-- Left: Image Gallery -->
        <div class="product-gallery-container">
            <div class="gallery-main-display">
                <button class="gallery-carousel-arrow arrow-left" id="galleryPrevBtn">&lt;</button>
                <img src="" alt="Main product image" id="mainProductDisplayImage">
                <button class="gallery-carousel-arrow arrow-right" id="galleryNextBtn">&gt;</button>
            </div>
            <div class="gallery-thumbnails" id="galleryThumbnailsRow"></div>
        </div>

        <!-- Middle: Product Specs & Details -->
        <div class="product-info-details">
            <div class="in-stock-badge">
                <svg viewBox="0 0 24 24" width="18" height="18"><path fill="currentColor" d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
                <span>In stock</span>
            </div>

            <h1 class="product-details-title" id="productDetailTitle"></h1>

            <div class="product-meta-row">
                <div class="meta-rating-row">
                    <span id="starRatingBox"></span>
                    <span class="meta-rating-num" id="ratingNumber"></span>
                </div>
                <span>|</span>
                <a href="#" class="meta-reviews-link" id="reviewCount">0 reviews</a>
                <span>|</span>
                <span id="soldCount">0 sold</span>
            </div>

            <!-- Tiered Pricing -->
            <div class="pricing-tiers-container">
                <div class="pricing-box-tier">
                    <span class="tier-price" id="tierPrice1"></span>
                    <span class="tier-qty">50-100 pcs</span>
                </div>
                <div class="pricing-box-tier">
                    <span class="tier-price" id="tierPrice2"></span>
                    <span class="tier-qty">100-700 pcs</span>
                </div>
                <div class="pricing-box-tier">
                    <span class="tier-price" id="tierPrice3"></span>
                    <span class="tier-qty">700+ pcs</span>
                </div>
            </div>

            <!-- Specifications -->
            <table class="specifications-table">
                <tr><td class="spec-label">Price:</td><td class="spec-value" style="color: var(--badge-red);">Negotiable</td></tr>
                <tr><td class="spec-label">Type:</td><td class="spec-value" id="specType"></td></tr>
                <tr><td class="spec-label">Material:</td><td class="spec-value" id="specMaterial"></td></tr>
                <tr><td class="spec-label">Design:</td><td class="spec-value" id="specDesign"></td></tr>
                <tr><td class="spec-label">Customization:</td><td class="spec-value">Customized logo available</td></tr>
                <tr><td class="spec-label">Warranty:</td><td class="spec-value">2 years full warranty</td></tr>
            </table>
        </div>

        <!-- Right: Seller Card -->
        <aside class="seller-card-wrapper">
            <div class="seller-info-card">
                <div class="seller-header">
                    <div class="seller-logo-box">R</div>
                    <div class="seller-name-block">
                        <span class="seller-title">Supplier</span>
                        <span class="seller-company">Guanjoi Trading LLC</span>
                    </div>
                </div>
                <div class="seller-meta-row">
                    <div class="seller-meta-item"><span class="flag-icon de-flag"></span><span>Germany, Berlin</span></div>
                    <div class="seller-meta-item"><svg width="16" height="16" style="color:#2ecc71;"><path fill="currentColor" d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4z"/></svg><span>Verified Seller</span></div>
                    <div class="seller-meta-item"><svg width="16" height="16"><path fill="currentColor" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"/></svg><span>Worldwide shipping</span></div>
                </div>
                <div class="seller-actions">
                    <button class="btn btn-blue btn-full" id="sellerSendInquiryBtn">Send inquiry</button>
                    <button class="btn btn-white btn-full">Seller's profile</button>
                </div>
                <button class="save-later-link" id="saveForLaterBtn">
                    <svg width="16" height="16"><path fill="currentColor" d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                    <span>Save for later</span>
                </button>
            </div>
        </aside>
    </div>

    <!-- Tabs Section -->
    <div class="tabs-content-layout">
        <div class="tabs-card">
            <div class="tabs-nav-bar">
                <button class="tab-link active" data-tab="desc">Description</button>
                <button class="tab-link" data-tab="reviews">Reviews</button>
                <button class="tab-link" data-tab="shipping">Shipping</button>
                <button class="tab-link" data-tab="seller">About seller</button>
            </div>
            <div class="tab-body-pane">
                <div class="tab-pane-content active" id="tab-desc">
                    <p class="description-text" id="productDescription"></p>
                    <ul class="features-check-list" id="featuresList"></ul>
                </div>
                <div class="tab-pane-content" id="tab-reviews"><h4>Customer Reviews</h4><p id="reviewsText"></p></div>
                <div class="tab-pane-content" id="tab-shipping"><h4>Shipping & Delivery</h4><p>Worldwide shipping available. Estimated delivery: 7-15 business days.</p></div>
                <div class="tab-pane-content" id="tab-seller"><h4>About Supplier</h4><p>Established in Berlin, trusted wholesale supplier since 2015.</p></div>
            </div>
        </div>
        <aside class="you-may-like-card"><h3 class="you-may-like-title">You may like</h3><div class="you-may-like-list" id="youMayLikeList"></div></aside>
    </div>

    <section class="related-products-section card-box" style="padding:24px;">
        <h2 class="section-title-md">Related products</h2>
        <div class="related-products-grid" id="relatedProductsGrid"></div>
    </section>
@endsection

@push('scripts')
    <script>
        window.productId = '{{ $id }}';
    </script>
    <script src="{{ asset('js/product-detail.js') }}"></script>
@endpush