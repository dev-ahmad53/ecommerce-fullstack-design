@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <style>
        /* ============================================
           HOME AND OUTDOOR / ELECTRONICS SHOWCASE
           ============================================ */
        
        .showcase-block {
            margin: 30px 0;
        }
        
        .showcase-layout {
            display: grid;
            grid-template-columns: 280px 1fr;
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            overflow: hidden;
        }
        
        .showcase-banner {
            padding: 24px;
            background-size: cover;
            background-position: center;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 320px;
        }
        
        .showcase-banner-title {
            font-size: 20px;
            font-weight: 700;
            line-height: 1.3;
            color: var(--text-main);
        }
        
        .showcase-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-template-rows: repeat(2, 1fr);
        }
        
        .showcase-card {
            padding: 16px;
            border-right: 1px solid var(--border-color);
            border-bottom: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.2s;
            cursor: pointer;
            text-decoration: none;
            color: inherit;
        }
        
        .showcase-card:hover {
            box-shadow: inset 0 0 10px rgba(0,0,0,0.03);
            background: #fafbfc;
        }
        
        .showcase-card:nth-child(4n) {
            border-right: none;
        }
        
        .showcase-card:nth-child(n+5) {
            border-bottom: none;
        }
        
        .showcase-card-info {
            display: flex;
            flex-direction: column;
            max-width: 110px;
        }
        
        .showcase-card-title {
            font-size: 14px;
            font-weight: 500;
            color: var(--text-main);
            margin-bottom: 4px;
        }
        
        .showcase-card-price {
            font-size: 12px;
            color: var(--text-muted);
        }
        
        .showcase-card-img {
            width: 82px;
            height: 82px;
            object-fit: contain;
        }
        
        .mobile-source-link-wrapper {
            display: none;
        }
        
        /* ============================================
           RESPONSIVE
           ============================================ */
        @media (max-width: 1200px) {
            .showcase-layout {
                grid-template-columns: 240px 1fr;
            }
            .showcase-grid {
                grid-template-columns: repeat(3, 1fr);
            }
            .showcase-card:nth-child(4n) {
                border-right: 1px solid var(--border-color);
            }
            .showcase-card:nth-child(3n) {
                border-right: none;
            }
        }
        
        @media (max-width: 992px) {
            .showcase-layout {
                grid-template-columns: 1fr;
            }
            .showcase-banner {
                padding: 30px;
                height: 150px;
                flex-direction: row;
                align-items: center;
                min-height: unset;
            }
            .showcase-banner-title {
                margin-bottom: 0;
            }
        }
        
        @media (max-width: 768px) {
            .showcase-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .showcase-card:nth-child(3n) {
                border-right: 1px solid var(--border-color);
            }
            .showcase-card:nth-child(2n) {
                border-right: none;
            }
            .mobile-source-link-wrapper {
                display: block;
                padding: 12px 16px;
                border-top: 1px solid var(--border-color);
            }
            .mobile-source-link {
                color: var(--primary-blue);
                font-weight: 600;
                display: flex;
                align-items: center;
                gap: 6px;
            }
        }
        
        @media (max-width: 576px) {
            .showcase-grid {
                grid-template-columns: 1fr;
            }
            .showcase-card {
                border-right: none;
            }
            .showcase-card:nth-child(n) {
                border-bottom: 1px solid var(--border-color);
            }
            .showcase-card:last-child {
                border-bottom: none;
            }
        }
    </style>
@endpush

@section('title', 'Brand - Global E-commerce Marketplace & Supplier Network')

@section('content')
    <!-- Hero Grid Section -->
    <section class="hero-grid-section">
        <aside class="sidebar-categories" id="heroSidebar">
            <ul class="sidebar-list list-unstyled">
                <li><a href="#automobiles" class="sidebar-item active">Automobiles</a></li>
                <li><a href="#clothing" class="sidebar-item">Clothes and wear</a></li>
                <li><a href="#interiors" class="sidebar-item">Home Interiors</a></li>
                <li><a href="#tech" class="sidebar-item">Computer and tech</a></li>
                <li><a href="#tools" class="sidebar-item">Tools, equipments</a></li>
                <li><a href="#sports" class="sidebar-item">Sports and outdoor</a></li>
                <li><a href="#pets" class="sidebar-item">Animal and pets</a></li>
                <li><a href="#machinery" class="sidebar-item">Machinery tools</a></li>
                <li><a href="#all" class="sidebar-item">More category</a></li>
            </ul>
        </aside>

        <div class="hero-main-banner" style="background-image: linear-gradient(135deg, rgba(227, 242, 253, 0.9) 0%, rgba(200, 230, 201, 0.7) 100%);">
            <div class="banner-content">
                <span class="banner-subtitle">Latest trending</span>
                <h1 class="banner-title">Electronic items</h1>
                <button class="btn btn-white modal-trigger-btn" data-modal="hero-banner-modal">Learn more</button>
            </div>
            <div class="banner-image-container">
                <img src="{{ asset('images/hero_electronics.png') }}" alt="Latest trending electronic items" class="banner-img">
            </div>
        </div>

        <div class="hero-right-cards">
            <div class="promo-card user-welcome-card">
                <div class="user-info d-flex align-items-center gap-3">
                    <div class="user-avatar-bg">
                        <svg viewBox="0 0 24 24" width="24" height="24"><path fill="#0d6efd" d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                    </div>
                    <p class="user-greeting mb-0">Hi, user<br>let's get started</p>
                </div>
                <button class="btn btn-blue w-100 btn-sm auth-btn" data-action="join">Join now</button>
                <button class="btn btn-white w-100 btn-sm auth-btn" data-action="login">Log in</button>
            </div>

            <div class="promo-card discount-orange-card">
                <p class="card-promo-text mb-0">Get US $10 off with a new supplier</p>
            </div>

            <div class="promo-card pref-teal-card">
                <p class="card-promo-text mb-0">Send quotes with supplier preferences</p>
            </div>
        </div>
    </section>

    <!-- Deals and Offers Section -->
    <section id="deals" class="deals-offers-section card-box">
        <div class="deals-left-timer">
            <div class="deals-header">
                <h2 class="section-title-md">Deals and offers</h2>
                <p class="deals-subtitle">Hygiene equipments</p>
            </div>
            <div class="countdown-timer d-flex gap-2" id="dealsTimer">
                <div class="timer-unit text-center">
                    <span class="timer-num d-block" id="timerDays">04</span>
                    <span class="timer-label">Days</span>
                </div>
                <div class="timer-unit text-center">
                    <span class="timer-num d-block" id="timerHours">13</span>
                    <span class="timer-label">Hour</span>
                </div>
                <div class="timer-unit text-center">
                    <span class="timer-num d-block" id="timerMins">34</span>
                    <span class="timer-label">Min</span>
                </div>
                <div class="timer-unit text-center">
                    <span class="timer-num d-block" id="timerSecs">56</span>
                    <span class="timer-label">Sec</span>
                </div>
            </div>
        </div>

        <div class="deals-products-grid">
            @php
                $deals = [
                    ['id' => 'deal-1', 'name' => 'Smart Watch Sport Series', 'price' => 75, 'img' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=300&auto=format&fit=crop&q=80', 'title' => 'Smart watches', 'badge' => '-25%'],
                    ['id' => 'deal-2', 'name' => 'Pro Laptop Pro 15', 'price' => 899, 'img' => 'https://images.unsplash.com/photo-1496181130204-7552cc14f1d0?w=300&auto=format&fit=crop&q=80', 'title' => 'Laptops', 'badge' => '-15%'],
                    ['id' => 'deal-3', 'name' => 'Action Camera 4K', 'price' => 120, 'img' => 'https://images.unsplash.com/photo-1502920917128-1da500764c6e?w=300&auto=format&fit=crop&q=80', 'title' => 'GoPro cameras', 'badge' => '-40%'],
                    ['id' => 'deal-4', 'name' => 'Hi-Fi Wireless Headphones', 'price' => 90, 'img' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=300&auto=format&fit=crop&q=80', 'title' => 'Headphones', 'badge' => '-25%'],
                    ['id' => 'deal-5', 'name' => 'DSLR Professional Camera', 'price' => 450, 'img' => 'https://images.unsplash.com/photo-1516035069371-29a1b244cc32?w=300&auto=format&fit=crop&q=80', 'title' => 'Canon cameras', 'badge' => '-25%']
                ];
            @endphp
            @foreach($deals as $deal)
            <div class="deal-card-item product-action-card text-center" data-id="{{ $deal['id'] }}" data-name="{{ $deal['name'] }}" data-price="{{ $deal['price'] }}">
                <div class="deal-img-wrapper">
                    <img src="{{ $deal['img'] }}" alt="{{ $deal['title'] }}">
                </div>
                <p class="deal-item-title mb-1">{{ $deal['title'] }}</p>
                <span class="badge badge-danger">{{ $deal['badge'] }}</span>
            </div>
            @endforeach
        </div>
    </section>

    <!-- ========================================== -->
    <!-- SHOWCASE 1: HOME AND OUTDOOR               -->
    <!-- ========================================== -->
    <section id="interiors" class="showcase-block">
        <div class="showcase-layout">
            <div class="showcase-banner" style="background-image: linear-gradient(rgba(0,0,0,0.05), rgba(0,0,0,0.05)), url('https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?w=500&auto=format&fit=crop&q=80');">
                <div>
                    <h2 class="showcase-banner-title">Home and<br>outdoor</h2>
                </div>
                <a href="{{ route('products.index') }}?category=home" class="btn btn-white btn-sm">Source now</a>
            </div>

            <div class="showcase-grid" id="home-showcase-container">
                @php
                    $homeProducts = [
                        ['id' => 'ho-1', 'name' => 'Modern Soft', 'price' => 30, 'img' => 'https://images.unsplash.com/photo-1567538096630-e0c55bd6374c?w=200&auto=format&fit=crop&q=80', 'title' => 'Modern Soft'],
                        ['id' => 'ho-2', 'name' => 'Ergonomic Sofa', 'price' => 49, 'img' => 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=200&auto=format&fit=crop&q=80', 'title' => 'Ergonomic Sofa'],
                        ['id' => 'ho-3', 'name' => 'Kitchen Ceramic', 'price' => 25, 'img' => 'https://images.unsplash.com/photo-1610701596007-11502861dcfa?w=200&auto=format&fit=crop&q=80', 'title' => 'Kitchen Ceramic'],
                        ['id' => 'ho-4', 'name' => 'Retro Kitchen', 'price' => 89, 'img' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=200&auto=format&fit=crop&q=80', 'title' => 'Retro Kitchen'],
                        ['id' => 'ho-5', 'name' => 'High-Speed Counter', 'price' => 34, 'img' => 'https://images.unsplash.com/photo-1578643463396-0997cb5328c1?w=200&auto=format&fit=crop&q=80', 'title' => 'High-Speed Counter'],
                        ['id' => 'ho-6', 'name' => 'Smart Coffee', 'price' => 115, 'img' => 'https://images.unsplash.com/photo-1517256064527-09c53b2d0bc6?w=200&auto=format&fit=crop&q=80', 'title' => 'Smart Coffee'],
                        ['id' => 'ho-7', 'name' => 'Water Boiler', 'price' => 79, 'img' => 'https://images.unsplash.com/photo-1594228135964-943f25d905aa?w=200&auto=format&fit=crop&q=80', 'title' => 'Water Boiler'],
                        ['id' => 'ho-8', 'name' => 'Traditional Clay', 'price' => 10, 'img' => 'https://images.unsplash.com/photo-1612196808214-b8e1d6145a8c?w=200&auto=format&fit=crop&q=80', 'title' => 'Traditional Clay']
                    ];
                @endphp
                @foreach($homeProducts as $product)
                <a href="{{ route('products.show', $product['id']) }}" class="showcase-card product-action-card" data-id="{{ $product['id'] }}">
                    <div class="showcase-card-info">
                        <h4 class="showcase-card-title">{{ $product['title'] }}</h4>
                        <span class="showcase-card-price">From USD {{ $product['price'] }}</span>
                    </div>
                    <img class="showcase-card-img" src="{{ $product['img'] }}" alt="{{ $product['title'] }}">
                </a>
                @endforeach
            </div>
            
            <!-- <div class="mobile-source-link-wrapper text-center py-3">
                <a href="#" class="mobile-source-link category-source-btn" data-category="Home and Outdoor">Source now <i class="fas fa-arrow-right"></i></a>
            </div> -->
        </div>
    </section>

    <!-- ========================================== -->
    <!-- SHOWCASE 2: CONSUMER ELECTRONICS           -->
    <!-- ========================================== -->
    <section id="tech" class="showcase-block">
        <div class="showcase-layout">
            <div class="showcase-banner" style="background-image: linear-gradient(rgba(0,0,0,0.05), rgba(0,0,0,0.05)), url('https://images.unsplash.com/photo-1542751371-adc38448a05e?w=500&auto=format&fit=crop&q=80');">
                <div>
                    <h2 class="showcase-banner-title">Consumer<br>electronics and<br>gadgets</h2>
                </div>
                <a href="{{ route('products.index') }}?category=home" class="btn btn-white btn-sm">Source now</a>
            </div>

            <div class="showcase-grid" id="electronics-showcase-container">
                @php
                    $elecProducts = [
                        ['id' => 'el-1', 'name' => 'Smart Watch', 'price' => 99, 'img' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=200&auto=format&fit=crop&q=80', 'title' => 'Smart Watch'],
                        ['id' => 'el-2', 'name' => 'MacBook Pro', 'price' => 849, 'img' => 'https://images.unsplash.com/photo-1496181130204-7552cc14f1d0?w=200&auto=format&fit=crop&q=80', 'title' => 'MacBook Pro'],
                        ['id' => 'el-3', 'name' => 'GoPro HERO4', 'price' => 100, 'img' => 'https://images.unsplash.com/photo-1502920917128-1da500764c6e?w=200&auto=format&fit=crop&q=80', 'title' => 'GoPro HERO4'],
                        ['id' => 'el-4', 'name' => 'Wireless Headset', 'price' => 149, 'img' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=200&auto=format&fit=crop&q=80', 'title' => 'Wireless Headset'],
                        ['id' => 'el-5', 'name' => 'Canon EOS', 'price' => 375, 'img' => 'https://images.unsplash.com/photo-1516035069371-29a1b244cc32?w=200&auto=format&fit=crop&q=80', 'title' => 'Canon EOS'],
                        ['id' => 'el-6', 'name' => 'iPhone 12', 'price' => 799, 'img' => 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=200&auto=format&fit=crop&q=80', 'title' => 'iPhone 12'],
                        ['id' => 'el-7', 'name' => 'Xiaomi Mi', 'price' => 329, 'img' => 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=200&auto=format&fit=crop&q=80', 'title' => 'Xiaomi Mi'],
                        ['id' => 'el-8', 'name' => 'Smart Watch', 'price' => 99, 'img' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=200&auto=format&fit=crop&q=80', 'title' => 'Smart Watch']
                    ];
                @endphp
                @foreach($elecProducts as $product)
                <a href="{{ route('products.show', $product['id']) }}" class="showcase-card product-action-card" data-id="{{ $product['id'] }}">
                    <div class="showcase-card-info">
                        <h4 class="showcase-card-title">{{ $product['title'] }}</h4>
                        <span class="showcase-card-price">From USD {{ $product['price'] }}</span>
                    </div>
                    <img class="showcase-card-img" src="{{ $product['img'] }}" alt="{{ $product['title'] }}">
                </a>
                @endforeach
            </div>

            <div class="mobile-source-link-wrapper text-center py-3">
                <a href="#" class="mobile-source-link category-source-btn" data-category="Consumer Electronics">Source now <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
    </section>

    <!-- Inquiry Section -->
    <section id="inquiry" class="inquiry-form-section" style="background-image: linear-gradient(90deg, rgba(13, 110, 253, 0.85) 0%, rgba(25, 118, 210, 0.7) 100%), url('https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=1200&auto=format&fit=crop&q=80');">
        <div class="inquiry-grid">
            <div class="inquiry-left-text">
                <h2 class="inquiry-main-title">An easy way to send requests to all suppliers</h2>
                <p class="inquiry-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                <button class="btn btn-blue mobile-inquiry-trigger-btn" id="mobileInquiryBtn">Send inquiry</button>
            </div>

            <div class="inquiry-right-card" id="inquiryCardContainer">
                <div class="inquiry-card-header">
                    <h3 class="inquiry-card-title">Send quote to suppliers</h3>
                </div>
                <form id="supplierInquiryForm" class="inquiry-form">
                    <div class="form-group mb-3">
                        <input type="text" id="inquiryItem" class="form-control" placeholder="What item you need?" required>
                    </div>
                    <div class="form-group mb-3">
                        <textarea id="inquiryDetails" rows="3" class="form-control" placeholder="Type more details" required></textarea>
                    </div>
                    <div class="form-row d-flex gap-3 mb-3">
                        <div class="form-group flex-grow-1">
                            <input type="number" id="inquiryQuantity" class="form-control" placeholder="Quantity" min="1" required>
                        </div>
                        <div class="form-group">
                            <select id="inquiryUnit" class="form-select">
                                <option value="pcs">Pcs</option>
                                <option value="kg">Kg</option>
                                <option value="liters">Liters</option>
                                <option value="boxes">Boxes</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-blue btn-inquiry-submit">Send inquiry</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Recommended Items Section -->
    <section id="recommended" class="recommended-section">
        <h2 class="section-title">Recommended items</h2>
        <div class="recommended-grid">
            @php
                $recommended = [
                    ['id' => 'rec-1', 'name' => "Modern Men's Blue Polo", 'price' => 10.30, 'img' => 'https://images.unsplash.com/photo-1521572267360-ee0c2909d518?w=300&auto=format&fit=crop&q=80', 'desc' => 'T-shirts with multiple colors, for men'],
                    ['id' => 'rec-2', 'name' => 'Winter Parka Jacket', 'price' => 10.30, 'img' => 'https://images.unsplash.com/photo-1591195853828-11db59a44f6b?w=300&auto=format&fit=crop&q=80', 'desc' => 'Jeans shorts for men blue color'],
                    ['id' => 'rec-3', 'name' => 'Sleek Winter Suit Jacket', 'price' => 12.50, 'img' => 'https://images.unsplash.com/photo-1593032465175-481ac7f401a0?w=300&auto=format&fit=crop&q=80', 'desc' => 'Brown winter coat medium size'],
                    ['id' => 'rec-4', 'name' => 'Leather Office Travel Bag', 'price' => 34.00, 'img' => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=300&auto=format&fit=crop&q=80', 'desc' => 'Jeans bag for travel for men'],
                    ['id' => 'rec-5', 'name' => 'Premium Casual Backpack', 'price' => 99.00, 'img' => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=300&auto=format&fit=crop&q=80', 'desc' => 'Leather wallet'],
                    ['id' => 'rec-6', 'name' => "Men's Fitted Shorts", 'price' => 9.99, 'img' => 'https://images.unsplash.com/photo-1591195853828-11db59a44f6b?w=300&auto=format&fit=crop&q=80', 'desc' => 'Canon camera black, 100x zoom'],
                    ['id' => 'rec-7', 'name' => 'Wireless Headset Pro', 'price' => 8.99, 'img' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=300&auto=format&fit=crop&q=80', 'desc' => 'Headset for gaming with mic'],
                    ['id' => 'rec-8', 'name' => 'Compact Leather Clutch', 'price' => 10.30, 'img' => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=300&auto=format&fit=crop&q=80', 'desc' => 'Smart watch clean color modern'],
                    ['id' => 'rec-9', 'name' => 'Handcrafted Clay Pot', 'price' => 10.30, 'img' => 'https://images.unsplash.com/photo-1612196808214-b8e1d6145a8c?w=300&auto=format&fit=crop&q=80', 'desc' => 'Blue wallet for men leather material'],
                    ['id' => 'rec-10', 'name' => 'Steel Electric Thermos Kettle', 'price' => 80.95, 'img' => 'https://images.unsplash.com/photo-1594228135964-943f25d905aa?w=300&auto=format&fit=crop&q=80', 'desc' => 'Jeans bag for travel for men']
                ];
            @endphp
            @foreach($recommended as $item)
            <div class="recommended-card product-action-card" data-id="{{ $item['id'] }}" data-name="{{ $item['name'] }}" data-price="{{ $item['price'] }}">
                <div class="rec-img-wrapper">
                    <img src="{{ $item['img'] }}" alt="{{ $item['name'] }}">
                </div>
                <div class="rec-details">
                    <p class="rec-price mb-0">${{ number_format($item['price'], 2) }}</p>
                    <p class="rec-desc mb-0">{{ $item['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- Extra Services Section -->
    <section class="services-section">
        <h2 class="section-title">Our extra services</h2>
        <div class="services-grid">
            <div class="service-card">
                <div class="service-img-container">
                    <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=400&auto=format&fit=crop&q=80" alt="Industry Hubs">
                </div>
                <div class="service-icon-btn">
                    <i class="fas fa-search"></i>
                </div>
                <div class="service-content">
                    <h3 class="service-card-title">Source from Industry Hubs</h3>
                </div>
            </div>

            <div class="service-card">
                <div class="service-img-container">
                    <img src="https://images.unsplash.com/photo-1513364776144-60967b0f800f?w=400&auto=format&fit=crop&q=80" alt="Customize Products">
                </div>
                <div class="service-icon-btn">
                    <i class="fas fa-palette"></i>
                </div>
                <div class="service-content">
                    <h3 class="service-card-title">Customize Your Products</h3>
                </div>
            </div>

            <div class="service-card">
                <div class="service-img-container">
                    <img src="https://images.unsplash.com/photo-1436491865332-7a61a109cc05?w=400&auto=format&fit=crop&q=80" alt="Fast Reliable Shipping">
                </div>
                <div class="service-icon-btn">
                    <i class="fas fa-shipping-fast"></i>
                </div>
                <div class="service-content">
                    <h3 class="service-card-title">Fast, reliable shipping by ocean or air</h3>
                </div>
            </div>

            <div class="service-card">
                <div class="service-img-container">
                    <img src="https://images.unsplash.com/photo-1581092160607-ee22621dd758?w=400&auto=format&fit=crop&q=80" alt="Product Inspection">
                </div>
                <div class="service-icon-btn">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <div class="service-content">
                    <h3 class="service-card-title">Product monitoring and inspection</h3>
                </div>
            </div>
        </div>
    </section>

    <!-- Suppliers by Region Section -->
    <section class="regions-section">
        <h2 class="section-title">Suppliers by region</h2>
        <div class="regions-grid">
            <div class="region-item d-flex gap-3">
                <span class="flag-icon ae-flag"></span>
                <div class="region-info">
                    <span class="region-name d-block">Arabic Emirates</span>
                    <a href="#" class="region-link">shopname.ae</a>
                </div>
            </div>
            <div class="region-item d-flex gap-3">
                <span class="flag-icon au-flag"></span>
                <div class="region-info">
                    <span class="region-name d-block">Australia</span>
                    <a href="#" class="region-link">shopname.au</a>
                </div>
            </div>
            <div class="region-item d-flex gap-3">
                <span class="flag-icon us-flag"></span>
                <div class="region-info">
                    <span class="region-name d-block">United States</span>
                    <a href="#" class="region-link">shopname.us</a>
                </div>
            </div>
            <div class="region-item d-flex gap-3">
                <span class="flag-icon ru-flag"></span>
                <div class="region-info">
                    <span class="region-name d-block">Russia</span>
                    <a href="#" class="region-link">shopname.ru</a>
                </div>
            </div>
            <div class="region-item d-flex gap-3">
                <span class="flag-icon it-flag"></span>
                <div class="region-info">
                    <span class="region-name d-block">Italy</span>
                    <a href="#" class="region-link">shopname.it</a>
                </div>
            </div>
            <div class="region-item d-flex gap-3">
                <span class="flag-icon dk-flag"></span>
                <div class="region-info">
                    <span class="region-name d-block">Denmark</span>
                    <a href="#" class="region-link">shopname.dk</a>
                </div>
            </div>
            <div class="region-item d-flex gap-3">
                <span class="flag-icon fr-flag"></span>
                <div class="region-info">
                    <span class="region-name d-block">France</span>
                    <a href="#" class="region-link">shopname.fr</a>
                </div>
            </div>
            <div class="region-item d-flex gap-3">
                <span class="flag-icon cn-flag"></span>
                <div class="region-info">
                    <span class="region-name d-block">China</span>
                    <a href="#" class="region-link">shopname.cn</a>
                </div>
            </div>
            <div class="region-item d-flex gap-3">
                <span class="flag-icon gb-flag"></span>
                <div class="region-info">
                    <span class="region-name d-block">Great Britain</span>
                    <a href="#" class="region-link">shopname.co.uk</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="newsletter-section">
        <h2 class="section-title">Subscribe on our newsletter</h2>
        <p class="newsletter-subtitle">Get daily news on upcoming offers from many suppliers all over the world</p>
        <form id="newsletterForm" class="newsletter-form d-flex gap-2">
            <div class="input-wrapper position-relative flex-grow-1">
                <i class="fas fa-envelope email-input-icon position-absolute"></i>
                <input type="email" id="newsletterEmail" class="w-100" placeholder="Email" required>
            </div>
            <button type="submit" class="btn btn-blue">Subscribe</button>
        </form>
    </section>
@endsection

@push('scripts')
    <script src="{{ asset('js/home.js') }}"></script>
@endpush