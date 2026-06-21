// Product Details Page JavaScript

document.addEventListener('DOMContentLoaded', () => {

    // ============================================================
    // ALL PRODUCTS DATA (7 Products)
    // ============================================================
    
    const allProductsData = {
        'shop-1': {
            name: 'Apple iPhone 14 Pro',
            priceTiers: ['$999', '$949', '$899'],
            rating: 9.5,
            stars: 5,
            type: 'Smartphone',
            material: 'Glass & Titanium',
            design: 'Modern Premium',
            orders: 1250,
            reviews: 328,
            img: 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=500&auto=format&fit=crop&q=80',
            images: ['https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=500&auto=format&fit=crop&q=80'],
            desc: 'Latest flagship smartphone with A16 Bionic chip and 48MP camera.'
        },
        'shop-2': {
            name: 'Apple iPhone 14 Plus',
            priceTiers: ['$899', '$849', '$799'],
            rating: 9.0,
            stars: 4.5,
            type: 'Smartphone',
            material: 'Glass & Aluminum',
            design: 'Modern',
            orders: 890,
            reviews: 215,
            img: 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=500&auto=format&fit=crop&q=80',
            images: ['https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=500&auto=format&fit=crop&q=80'],
            desc: 'Bigger screen, longer battery life.'
        },
        'shop-3': {
            name: 'Poco F5 Pro',
            priceTiers: ['$499', '$469', '$439'],
            rating: 8.8,
            stars: 4,
            type: 'Gaming Phone',
            material: 'Plastic',
            design: 'Sporty',
            orders: 2100,
            reviews: 512,
            img: 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=500&auto=format&fit=crop&q=80',
            images: ['https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=500&auto=format&fit=crop&q=80'],
            desc: 'High performance gaming phone with Snapdragon 8+ Gen 1.'
        },
        'shop-4': {
            name: 'Samsung Galaxy Tab S9',
            priceTiers: ['$699', '$649', '$599'],
            rating: 9.2,
            stars: 4.5,
            type: 'Tablet',
            material: 'Aluminum',
            design: 'Sleek',
            orders: 560,
            reviews: 189,
            img: 'https://images.unsplash.com/photo-1542751371-adc38448a05e?w=500&auto=format&fit=crop&q=80',
            images: ['https://images.unsplash.com/photo-1542751371-adc38448a05e?w=500&auto=format&fit=crop&q=80'],
            desc: 'Premium Android tablet with S Pen included.'
        },
        'shop-5': {
            name: 'Samsung Galaxy S23 Ultra',
            priceTiers: ['$1199', '$1149', '$1099'],
            rating: 9.7,
            stars: 5,
            type: 'Smartphone',
            material: 'Glass & Titanium',
            design: 'Premium',
            orders: 3200,
            reviews: 856,
            img: 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=500&auto=format&fit=crop&q=80',
            images: ['https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=500&auto=format&fit=crop&q=80'],
            desc: 'Ultra premium smartphone with 200MP camera.'
        },
        'shop-6': {
            name: 'Apple MacBook Pro',
            priceTiers: ['$1999', '$1899', '$1799'],
            rating: 9.8,
            stars: 5,
            type: 'Laptop',
            material: 'Aluminum',
            design: 'Modern',
            orders: 450,
            reviews: 128,
            img: 'https://images.unsplash.com/photo-1496181130204-7552cc14f1d0?w=500&auto=format&fit=crop&q=80',
            images: ['https://images.unsplash.com/photo-1496181130204-7552cc14f1d0?w=500&auto=format&fit=crop&q=80'],
            desc: 'Powerful laptop for professionals with M2 Pro chip.'
        },
        'shop-7': {
            name: 'Apple Watch Ultra',
            priceTiers: ['$799', '$749', '$699'],
            rating: 9.6,
            stars: 5,
            type: 'Smart Watch',
            material: 'Titanium',
            design: 'Rugged',
            orders: 3400,
            reviews: 892,
            img: 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=500&auto=format&fit=crop&q=80',
            images: ['https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=500&auto=format&fit=crop&q=80'],
            desc: 'Most rugged and capable Apple Watch ever.'
        }
    };

    // ============================================================
    // GET PRODUCT ID
    // ============================================================
    
    let productId = window.productId || 'shop-1';
    
    if (!window.productId) {
        const urlParams = new URLSearchParams(window.location.search);
        productId = urlParams.get('id');
        if (!productId) {
            productId = window.location.pathname.split('/').pop();
        }
    }
    
    const product = allProductsData[productId] || allProductsData['shop-1'];
    
    // ============================================================
    // STATE
    // ============================================================
    
    let activeImageIndex = 0;
    let cart = JSON.parse(localStorage.getItem('brand_cart')) || [];

    // ============================================================
    // RENDER FUNCTIONS
    // ============================================================
    
    function renderStars(stars) {
        let result = '';
        for (let i = 0; i < Math.floor(stars); i++) result += '★';
        if (stars % 1 >= 0.5) result += '½';
        for (let i = result.length; i < 5; i++) result += '☆';
        return result;
    }

    function init() {
        document.getElementById('productDetailTitle').textContent = product.name;
        document.getElementById('ratingNumber').textContent = product.rating;
        document.getElementById('starRatingBox').textContent = renderStars(product.stars);
        document.getElementById('reviewCount').textContent = product.reviews + ' reviews';
        document.getElementById('soldCount').textContent = product.orders + ' sold';
        document.getElementById('tierPrice1').textContent = product.priceTiers[0];
        document.getElementById('tierPrice2').textContent = product.priceTiers[1];
        document.getElementById('tierPrice3').textContent = product.priceTiers[2];
        document.getElementById('specType').textContent = product.type;
        document.getElementById('specMaterial').textContent = product.material;
        document.getElementById('specDesign').textContent = product.design;
        document.getElementById('productDescription').textContent = product.desc;
        
        renderThumbnails();
        updateMainImage();
        updateCartCount();
        renderCart();
    }

    function renderThumbnails() {
        const container = document.getElementById('galleryThumbnailsRow');
        if (!container) return;
        
        container.innerHTML = product.images.map((img, index) => `
            <div class="thumb-item ${index === 0 ? 'active' : ''}" data-index="${index}">
                <img src="${img}" alt="Thumbnail">
            </div>
        `).join('');
        
        document.querySelectorAll('.thumb-item').forEach(thumb => {
            thumb.addEventListener('click', () => {
                activeImageIndex = parseInt(thumb.dataset.index);
                updateMainImage();
                updateActiveThumb();
            });
        });
    }

    function updateMainImage() {
        const mainImg = document.getElementById('mainProductDisplayImage');
        if (mainImg && product.images[activeImageIndex]) {
            mainImg.src = product.images[activeImageIndex];
        }
    }

    function updateActiveThumb() {
        document.querySelectorAll('.thumb-item').forEach((thumb, index) => {
            if (index === activeImageIndex) {
                thumb.classList.add('active');
            } else {
                thumb.classList.remove('active');
            }
        });
    }

    // Gallery navigation
    document.getElementById('galleryPrevBtn')?.addEventListener('click', () => {
        activeImageIndex = (activeImageIndex - 1 + product.images.length) % product.images.length;
        updateMainImage();
        updateActiveThumb();
    });

    document.getElementById('galleryNextBtn')?.addEventListener('click', () => {
        activeImageIndex = (activeImageIndex + 1) % product.images.length;
        updateMainImage();
        updateActiveThumb();
    });

    // Tabs
    document.querySelectorAll('.tab-link').forEach(link => {
        link.addEventListener('click', function() {
            document.querySelectorAll('.tab-link').forEach(l => l.classList.remove('active'));
            document.querySelectorAll('.tab-pane-content').forEach(p => p.classList.remove('active'));
            this.classList.add('active');
            const tabId = document.getElementById(`tab-${this.dataset.tab}`);
            if (tabId) tabId.classList.add('active');
        });
    });

    // Save for later
    document.getElementById('saveForLaterBtn')?.addEventListener('click', function() {
        this.classList.toggle('active');
        const span = this.querySelector('span');
        if (this.classList.contains('active')) {
            span.textContent = 'Saved for later';
            showToast('Saved to Wishlist');
        } else {
            span.textContent = 'Save for later';
            showToast('Removed from Wishlist');
        }
    });

    // Send inquiry
    document.getElementById('sellerSendInquiryBtn')?.addEventListener('click', () => {
        showToast(`Inquiry sent for "${product.name}"!`);
    });

    // Add to cart - Pricing Box Click
    document.querySelectorAll('.pricing-box-tier').forEach((box, index) => {
        box.addEventListener('click', () => {
            const price = parseFloat(product.priceTiers[index].replace('$', ''));
            addToCart(price);
        });
    });

    // ============================================================
    // ADD TO CART BUTTON - NEW
    // ============================================================
    document.getElementById('addToCartBtn')?.addEventListener('click', function() {
        // Get the first tier price (default)
        const priceText = document.getElementById('tierPrice1').textContent;
        const price = parseFloat(priceText.replace('$', '').replace(',', ''));
        addToCart(price);
    });

    // ============================================================
    // CART FUNCTIONS
    // ============================================================
    
    function addToCart(price) {
        const existingItem = cart.find(item => item.id === productId);
        if (existingItem) {
            existingItem.quantity += 1;
        } else {
            cart.push({
                id: productId,
                name: product.name.substring(0, 30),
                price: price,
                img: product.images[0],
                quantity: 1
            });
        }
        localStorage.setItem('brand_cart', JSON.stringify(cart));
        updateCartCount();
        renderCart();
        showToast(`Added "${product.name}" to cart! 🛒`);
    }

    function removeFromCart(itemId) {
        const index = cart.findIndex(item => item.id === itemId);
        if (index > -1) {
            cart.splice(index, 1);
            localStorage.setItem('brand_cart', JSON.stringify(cart));
            updateCartCount();
            renderCart();
            showToast(`Removed from cart`);
        }
    }

    function updateCartCount() {
        const count = cart.reduce((sum, item) => sum + item.quantity, 0);
        const badges = document.querySelectorAll('#cartCountBadge, #mobileCartCountBadge, #cartDrawerCount');
        badges.forEach(badge => { if (badge) badge.textContent = count; });
    }

    function renderCart() {
        const cartEmptyState = document.getElementById('cartEmptyState');
        const cartItemsList = document.getElementById('cartItemsList');
        const cartDrawerFooter = document.getElementById('cartDrawerFooter');
        const cartSubtotalValue = document.getElementById('cartSubtotalValue');
        
        if (cart.length === 0) {
            if (cartEmptyState) cartEmptyState.style.display = 'flex';
            if (cartItemsList) cartItemsList.style.display = 'none';
            if (cartDrawerFooter) cartDrawerFooter.style.display = 'none';
            return;
        }
        
        if (cartEmptyState) cartEmptyState.style.display = 'none';
        if (cartItemsList) cartItemsList.style.display = 'flex';
        if (cartDrawerFooter) cartDrawerFooter.style.display = 'block';
        
        if (cartItemsList) {
            cartItemsList.innerHTML = cart.map(item => `
                <div class="cart-item">
                    <img class="cart-item-img" src="${item.img}" alt="${item.name}">
                    <div class="cart-item-info">
                        <p class="cart-item-name">${item.name}</p>
                        <p class="cart-item-price">$${item.price.toFixed(2)} &times; ${item.quantity}</p>
                    </div>
                    <button class="cart-item-remove" data-id="${item.id}">Remove</button>
                </div>
            `).join('');
        }
        
        const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
        if (cartSubtotalValue) cartSubtotalValue.textContent = `$${subtotal.toFixed(2)}`;
    }

    // ============================================================
    // CART - DIRECT TO CART PAGE (NO DRAWER)
    // ============================================================

    document.getElementById('cartToggleBtn')?.addEventListener('click', (e) => {
        e.preventDefault();
        window.location.href = '/cart';
    });

    document.getElementById('mobileCartToggleBtn')?.addEventListener('click', (e) => {
        e.preventDefault();
        window.location.href = '/cart';
    });

    // Close cart drawer (kept for compatibility)
    document.getElementById('cartCloseBtn')?.addEventListener('click', () => {
        document.getElementById('cartDrawer')?.classList.remove('open');
        document.getElementById('cartOverlay').style.display = 'none';
        document.body.style.overflow = '';
    });

    document.getElementById('cartOverlay')?.addEventListener('click', () => {
        document.getElementById('cartDrawer')?.classList.remove('open');
        document.getElementById('cartOverlay').style.display = 'none';
        document.body.style.overflow = '';
    });

    document.getElementById('cartItemsList')?.addEventListener('click', (e) => {
        if (e.target.classList.contains('cart-item-remove')) {
            removeFromCart(e.target.dataset.id);
        }
    });

    document.getElementById('checkoutBtn')?.addEventListener('click', () => {
        window.location.href = '/cart';
    });

    function showToast(message) {
        const container = document.getElementById('toastContainer');
        if (!container) return;
        const toast = document.createElement('div');
        toast.className = 'toast success';
        toast.innerHTML = `<span>${message}</span>`;
        container.appendChild(toast);
        setTimeout(() => toast.remove(), 3000);
    }

    // ============================================================
    // SEARCH FUNCTIONALITY - DYNAMIC
    // ============================================================
    
    const searchInput = document.getElementById('searchInput');
    const searchSuggestions = document.getElementById('searchSuggestions');
    const globalSearchForm = document.getElementById('globalSearchForm');

    if (searchInput) {
        searchInput.addEventListener('input', async function() {
            const query = this.value.toLowerCase().trim();
            if (!query) {
                if (searchSuggestions) searchSuggestions.style.display = 'none';
                return;
            }

            try {
                const response = await fetch(`/api/products/search/${encodeURIComponent(query)}`);
                const matches = await response.json();

                if (searchSuggestions) {
                    if (matches.length === 0) {
                        searchSuggestions.innerHTML = `<div class="suggestion-item">No results found for "${query}"</div>`;
                    } else {
                        searchSuggestions.innerHTML = matches.slice(0, 5).map(prod => `
                            <div class="suggestion-item" data-id="shop-${prod.id}">
                                <img class="suggestion-thumb" src="${prod.image}" alt="${prod.name}">
                                <span>${prod.name}</span>
                            </div>
                        `).join('');
                    }
                    searchSuggestions.style.display = 'block';
                }
            } catch (error) {
                console.error('Search error:', error);
                if (searchSuggestions) {
                    searchSuggestions.innerHTML = `<div class="suggestion-item">Search error, please try again</div>`;
                    searchSuggestions.style.display = 'block';
                }
            }
        });
    }

    if (searchSuggestions) {
        searchSuggestions.addEventListener('click', (e) => {
            const item = e.target.closest('.suggestion-item');
            if (!item) return;
            const productId = item.dataset.id;
            if (productId) {
                if (searchInput) searchInput.value = '';
                searchSuggestions.style.display = 'none';
                window.location.href = `/product/${productId}`;
            }
        });
    }

    document.addEventListener('click', (e) => {
        if (searchInput && !searchInput.contains(e.target) && searchSuggestions && !searchSuggestions.contains(e.target)) {
            searchSuggestions.style.display = 'none';
        }
    });

    if (globalSearchForm) {
        globalSearchForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const query = searchInput ? searchInput.value.trim() : '';
            if (query) {
                window.location.href = `/products?search=${encodeURIComponent(query)}`;
            }
        });
    }

    // ============================================================
    // MOBILE SIDEBAR
    // ============================================================
    
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const mobileSidebar = document.getElementById('mobileSidebar');
    const mobileSidebarOverlay = document.getElementById('mobileSidebarOverlay');
    const mobileSidebarClose = document.getElementById('mobileSidebarClose');

    if (mobileMenuBtn) {
        mobileMenuBtn.addEventListener('click', () => {
            if (mobileSidebar) mobileSidebar.classList.add('open');
            if (mobileSidebarOverlay) mobileSidebarOverlay.style.display = 'block';
            document.body.style.overflow = 'hidden';
        });
    }
    
    if (mobileSidebarClose) {
        mobileSidebarClose.addEventListener('click', () => {
            if (mobileSidebar) mobileSidebar.classList.remove('open');
            if (mobileSidebarOverlay) mobileSidebarOverlay.style.display = 'none';
            document.body.style.overflow = '';
        });
    }

    // ============================================================
    // START
    // ============================================================
    
    init();
});