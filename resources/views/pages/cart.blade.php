@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <style>
        /* ============================================
           CART PAGE - MOBILE FIX
           ============================================ */
        
        .cart-layout-grid {
            display: grid;
            grid-template-columns: 1fr 340px;
            gap: 24px;
            margin: 20px 0;
            align-items: start;
        }

        .cart-list-card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 24px;
        }

        .cart-page-title {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .cart-items-wrapper {
            display: flex;
            flex-direction: column;
        }

        .cart-item-row {
            display: flex;
            gap: 16px;
            padding: 16px 0;
            border-bottom: 1px solid var(--border-color);
            align-items: flex-start;
            flex-wrap: wrap;
        }

        .cart-item-row:last-child {
            border-bottom: none;
        }

        .cart-item-thumb {
            width: 80px;
            height: 80px;
            background: var(--bg-main);
            border-radius: 6px;
            padding: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .cart-item-thumb img {
            max-height: 64px;
            object-fit: contain;
        }

        .cart-item-desc-col {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 4px;
            min-width: 150px;
        }

        .cart-item-title {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-main);
        }

        .cart-item-spec-text {
            font-size: 12px;
            color: var(--text-muted);
        }

        .cart-item-actions-row {
            display: flex;
            gap: 12px;
            margin-top: 8px;
        }

        .cart-item-action-link {
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            background: none;
            border: none;
            padding: 0;
        }

        .cart-item-action-link.remove {
            color: var(--badge-red);
        }

        .cart-item-action-link.save-later {
            color: var(--primary-blue);
        }

        .cart-item-qty-price-col {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 8px;
            min-width: 100px;
        }

        .cart-item-row-price {
            font-size: 16px;
            font-weight: 700;
            color: var(--text-main);
        }

        .cart-item-qty-select {
            padding: 4px 8px;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            background: var(--bg-input);
            cursor: pointer;
        }

        .cart-item-bottom-row {
            display: none;
            width: 100%;
            justify-content: space-between;
            align-items: center;
            margin-top: 8px;
        }

        .mobile-qty-adjuster {
            display: flex;
            align-items: center;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            overflow: hidden;
            height: 32px;
            background: var(--bg-card);
        }

        .mobile-qty-btn {
            width: 30px;
            height: 100%;
            background: var(--bg-main);
            cursor: pointer;
            font-weight: bold;
            font-size: 16px;
            border: none;
            color: var(--text-main);
        }

        .mobile-qty-input {
            width: 36px;
            text-align: center;
            font-weight: 600;
            border: none;
            background: none;
            font-size: 14px;
        }

        .cart-item-mobile-price {
            font-size: 16px;
            font-weight: 700;
            color: var(--text-main);
        }

        .cart-list-footer-row {
            display: flex;
            justify-content: space-between;
            margin-top: 16px;
            padding-top: 16px;
            border-top: 1px solid var(--border-color);
        }

        .cart-empty-state {
            padding: 40px 0;
            text-align: center;
        }

        .cart-empty-text {
            margin-top: 15px;
            font-weight: 500;
            color: var(--text-gray);
        }

        .cart-empty-btn {
            margin-top: 15px;
        }

        /* Trust Badges */
        .trust-badges-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-top: 24px;
        }

        .trust-badge-card {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .trust-icon-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--border-color);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .trust-badge-title {
            font-weight: 600;
            font-size: 13px;
        }

        .trust-badge-desc {
            font-size: 11px;
            color: var(--text-muted);
        }

        /* Saved Later */
        .saved-later-section {
            margin-top: 40px;
        }

        .saved-later-heading {
            margin-bottom: 20px;
        }

        .saved-later-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
        }

        .saved-later-card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 16px;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .saved-img-box {
            height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--bg-main);
            border-radius: 6px;
            padding: 8px;
        }

        .saved-img-box img {
            max-height: 80px;
            object-fit: contain;
        }

        .saved-price {
            font-size: 15px;
            font-weight: 700;
        }

        .saved-title {
            font-size: 13px;
            color: var(--text-gray);
        }

        .saved-later-actions {
            display: flex;
            gap: 8px;
            margin-top: 4px;
        }

        .btn-move-cart {
            color: var(--primary-blue);
            border: 1px solid var(--border-color);
            font-weight: 600;
            font-size: 12px;
            padding: 6px 12px;
            border-radius: 6px;
            background: none;
            cursor: pointer;
        }

        .btn-remove-saved {
            color: var(--badge-red);
            border: 1px solid var(--border-color);
            font-weight: 500;
            font-size: 12px;
            padding: 6px 12px;
            border-radius: 6px;
            background: none;
            cursor: pointer;
        }

        /* Summary */
        .summary-cards-column {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .coupon-card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 20px;
        }

        .coupon-title {
            font-size: 14px;
            font-weight: 500;
            color: var(--text-muted);
            margin-bottom: 12px;
        }

        .coupon-input-group {
            display: flex;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            overflow: hidden;
        }

        .coupon-input-group input {
            flex: 1;
            padding: 8px 12px;
            background: var(--bg-input);
            border: none;
            outline: none;
        }

        .coupon-apply-btn {
            background: var(--bg-main);
            color: var(--primary-blue);
            font-weight: 600;
            padding: 8px 16px;
            cursor: pointer;
            border-left: 1px solid var(--border-color);
            border: none;
        }

        .order-summary-card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            color: var(--text-gray);
            padding: 4px 0;
        }

        .summary-discount {
            color: var(--badge-red);
        }

        .summary-tax {
            color: #2ecc71;
        }

        .summary-row.total {
            border-top: 1px solid var(--border-color);
            padding-top: 12px;
            font-size: 18px;
            font-weight: 700;
            color: var(--text-main);
        }

        .checkout-green-btn {
            background: #00b517;
            color: white;
            font-weight: 600;
            font-size: 16px;
            padding: 12px;
            border-radius: 6px;
            cursor: pointer;
            border: none;
            width: 100%;
        }

        .checkout-green-btn:hover {
            background: #009c14;
        }

        .supported-payments {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-top: 10px;
            flex-wrap: wrap;
        }

        .payment-badge {
            background: var(--bg-main);
            border: 1px solid var(--border-color);
            border-radius: 4px;
            padding: 4px 10px;
            font-size: 10px;
            font-weight: bold;
            color: var(--text-muted);
        }

        /* Mobile Summary */
        .cart-mobile-summary-block {
            display: none;
            margin-top: 16px;
            padding-top: 16px;
            border-top: 1px solid var(--border-color);
        }

        .cart-mobile-summary-row {
            display: flex;
            justify-content: space-between;
            padding: 6px 0;
            font-size: 14px;
        }

        .cart-mobile-summary-row.mob-total {
            font-size: 18px;
            font-weight: 700;
            border-top: 1px solid var(--border-color);
            padding-top: 12px;
            margin-top: 4px;
        }

        .cart-mobile-checkout-btn {
            width: 100%;
            background: #00b517;
            color: white;
            font-weight: 600;
            font-size: 16px;
            padding: 12px;
            border-radius: 6px;
            cursor: pointer;
            border: none;
            margin-top: 12px;
        }

        .cart-mobile-checkout-btn:hover {
            background: #009c14;
        }

        /* Promo Banner */
        .promo-wide-banner {
            background: var(--primary-blue);
            color: white;
            border-radius: 8px;
            padding: 28px 30px;
            margin: 30px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .promo-banner-title {
            font-size: 20px;
            font-weight: 700;
        }

        .promo-banner-subtitle {
            font-size: 13px;
            opacity: 0.9;
        }

        .promo-shop-btn {
            background: var(--accent-orange);
            color: var(--text-white);
            font-weight: 600;
            padding: 10px 24px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
        }

        .promo-shop-btn:hover {
            background: var(--accent-orange-hover);
        }

        /* ============================================
           RESPONSIVE
           ============================================ */
        @media (max-width: 992px) {
            .cart-layout-grid {
                grid-template-columns: 1fr;
            }
            .saved-later-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .cart-list-card {
                padding: 16px;
                border-radius: 0;
                border-left: none;
                border-right: none;
            }

            .cart-page-title {
                font-size: 18px;
            }

            .cart-item-row {
                flex-direction: column;
                gap: 10px;
                padding: 16px 0;
            }

            .cart-item-thumb {
                width: 100%;
                height: auto;
                max-height: 120px;
                padding: 16px;
            }

            .cart-item-thumb img {
                max-height: 100px;
                width: 100%;
                object-fit: contain;
            }

            .cart-item-desc-col {
                width: 100%;
                min-width: unset;
            }

            .cart-item-actions-row {
                display: none;
            }

            .cart-item-qty-price-col {
                display: none;
            }

            .cart-item-bottom-row {
                display: flex;
            }

            .cart-mobile-summary-block {
                display: block;
            }

            .trust-badges-row {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .saved-later-grid {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .saved-later-card {
                flex-direction: row;
                align-items: center;
                padding: 12px 16px;
            }

            .saved-img-box {
                width: 70px;
                height: 70px;
                flex-shrink: 0;
            }

            .saved-img-box img {
                max-height: 60px;
            }

            .saved-later-actions {
                flex-direction: row;
                flex-wrap: wrap;
            }

            .promo-wide-banner {
                flex-direction: column;
                text-align: center;
                gap: 12px;
                padding: 20px;
            }

            .summary-cards-column {
                padding: 0 4px;
            }
        }

        @media (max-width: 480px) {
            .cart-item-thumb {
                max-height: 100px;
            }

            .cart-item-title {
                font-size: 13px;
            }

            .cart-item-mobile-price {
                font-size: 14px;
            }

            .mobile-qty-btn {
                width: 26px;
                font-size: 14px;
            }

            .mobile-qty-input {
                width: 30px;
                font-size: 12px;
            }
        }
    </style>
@endpush

@section('title', 'Shopping Cart - Brand')

@section('content')
<div class="container">
    <div class="cart-layout-grid">

        <!-- ===== LEFT: Cart Items ===== -->
        <div class="cart-left-column">
            <div class="cart-list-card">
                <h1 class="cart-page-title" id="cartPageTitleHeader">My cart (0)</h1>

                <div class="cart-items-wrapper" id="cartPageItemsWrapper">
                    <!-- Empty state -->
                    <div id="cartPageEmptyState" class="cart-empty-state">
                        <svg viewBox="0 0 24 24" width="64" height="64"><path fill="#bdc3c7" d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.08-.14.12-.31.12-.48 0-.55-.45-1-1-1H5.21l-.94-2H1zm16 16c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z"/></svg>
                        <p class="cart-empty-text">Your shopping cart is empty</p>
                        <a href="{{ route('products.index') }}" class="btn btn-blue btn-sm cart-empty-btn">Shop Now</a>
                    </div>
                </div>

                {{-- Mobile summary block --}}
                <div class="cart-mobile-summary-block" id="cartMobileSummaryBlock">
                    <div class="cart-mobile-summary-row">
                        <span id="mobSummaryItemsLabel">Items (0):</span>
                        <span id="mobSummaryItems">$0.00</span>
                    </div>
                    <div class="cart-mobile-summary-row">
                        <span>Shipping:</span>
                        <span id="mobSummaryShipping">$0.00</span>
                    </div>
                    <div class="cart-mobile-summary-row">
                        <span>Tax:</span>
                        <span id="mobSummaryTax">$0.00</span>
                    </div>
                    <div class="cart-mobile-summary-row mob-total">
                        <span>Total:</span>
                        <span id="mobSummaryTotal">$0.00</span>
                    </div>
                    <button class="cart-mobile-checkout-btn" id="cartMobileCheckoutBtn">
                        Checkout (0 items)
                    </button>
                </div>

                {{-- Desktop footer --}}
                <div class="cart-list-footer-row" id="cartPageFooterActions" style="display:none;">
                    <a href="{{ route('products.index') }}" class="btn btn-blue btn-sm">← Back to shop</a>
                    <button class="btn btn-white btn-sm" id="cartPageClearAllBtn" style="color:var(--badge-red);">Remove all</button>
                </div>
            </div>

            <!-- Trust Badges -->
            <div class="trust-badges-row">
                <div class="trust-badge-card">
                    <div class="trust-icon-circle"><svg viewBox="0 0 24 24" width="20" height="20"><path fill="currentColor" d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z"/></svg></div>
                    <div class="trust-badge-text"><span class="trust-badge-title">Secure payment</span><span class="trust-badge-desc">100% secure</span></div>
                </div>
                <div class="trust-badge-card">
                    <div class="trust-icon-circle"><svg viewBox="0 0 24 24" width="20" height="20"><path fill="currentColor" d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zM6 9h12v2H6V9zm8 5H6v-2h8v2zm4-6H6V6h12v2z"/></svg></div>
                    <div class="trust-badge-text"><span class="trust-badge-title">Customer support</span><span class="trust-badge-desc">24/7 available</span></div>
                </div>
                <div class="trust-badge-card">
                    <div class="trust-icon-circle"><svg viewBox="0 0 24 24" width="20" height="20"><path fill="currentColor" d="M20 8h-3V4H3c-1.1 0-2 .9-2 2v11h2c0 1.66 1.34 3 3 3s3-1.34 3-3h6c0 1.66 1.34 3 3 3s3-1.34 3-3h2v-5l-3-4zM6 18.5c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zm11.5-5.5h-2.5V9h2.5v4zm-1.5 5.5c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5z"/></svg></div>
                    <div class="trust-badge-text"><span class="trust-badge-title">Free delivery</span><span class="trust-badge-desc">On orders over $50</span></div>
                </div>
            </div>

            <!-- Saved for Later -->
            <section class="saved-later-section">
                <h2 class="section-title-md saved-later-heading">Saved for later</h2>
                <div class="saved-later-grid" id="savedLaterItemsGrid"></div>
            </section>
        </div>

        <!-- ===== RIGHT: Desktop Summary ===== -->
        <div class="summary-cards-column">

            <div class="coupon-card">
                <span class="coupon-title">Have a coupon?</span>
                <div class="coupon-input-group">
                    <input type="text" id="couponInput" placeholder="Add coupon">
                    <button class="coupon-apply-btn" id="couponApplyBtn">Apply</button>
                </div>
            </div>

            <div class="order-summary-card">
                <div class="summary-row"><span>Subtotal:</span><span id="summarySubtotal">$0.00</span></div>
                <div class="summary-row summary-discount"><span>Discount:</span><span id="summaryDiscount">-$0.00</span></div>
                <div class="summary-row summary-tax"><span>Tax:</span><span id="summaryTax">+$0.00</span></div>
                <div class="summary-row total"><span>Total:</span><span id="summaryTotal">$0.00</span></div>
                <button class="checkout-green-btn" id="summaryCheckoutBtn">Checkout</button>
                <div class="supported-payments">
                    <span class="payment-badge">AMEX</span>
                    <span class="payment-badge">MC</span>
                    <span class="payment-badge">Paypal</span>
                    <span class="payment-badge">VISA</span>
                    <span class="payment-badge">Pay</span>
                </div>
            </div>

        </div>

    </div>

    <!-- Promo Banner -->
    <section class="promo-wide-banner">
        <div class="promo-banner-text">
            <span class="promo-banner-title">Super discount on more than 100 USD</span>
            <span class="promo-banner-subtitle">Shop now and save big!</span>
        </div>
        <button class="promo-shop-btn" onclick="window.location.href='{{ route('products.index') }}'">Shop now</button>
    </section>
</div>
@endsection

@push('scripts')
    <script>
        window.cartData = @json($cart ?? []);
    </script>
    <script src="{{ asset('js/cart.js') }}"></script>
@endpush