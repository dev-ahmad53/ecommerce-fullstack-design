// Product Listing Page JavaScript

document.addEventListener('DOMContentLoaded', () => {

    // ============================================================
    // 1. PRODUCT DATA - DYNAMIC FROM API
    // ============================================================
    
    let allProducts = [];
    let isLoading = true;
    let isMobile = window.innerWidth <= 700;
    let currentLayout = isMobile ? 'list' : 'grid';
    let currentPage = 1;
    let itemsPerPage = 10;
    let cart = JSON.parse(localStorage.getItem('brand_cart')) || [];
    
    let activeFilters = {
        brands: isMobile ? ['Huawei', 'Apple'] : ['Samsung', 'Apple', 'Poco'],
        features: isMobile ? ['64GB'] : ['Metallic'],
        ratings: isMobile ? [] : [4, 3],
        minPrice: null,
        maxPrice: null,
        verifiedOnly: false
    };

    // You may also like - Static data
    const youMayAlsoLike = [
        { id: 'rec-5', name: 'Premium Casual Backpack', price: 10.30, img: 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=300&auto=format&fit=crop&q=80', desc: 'Solid Backpack blue jeans large size' },
        { id: 'el-4', name: 'Elegant Smart Watch Gold', price: 10.30, img: 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=300&auto=format&fit=crop&q=80', desc: 'T-shirts with multiple colors, for men' },
        { id: 'ho-1', name: 'Premium Soft Chair', price: 10.30, img: 'https://images.unsplash.com/photo-1567538096630-e0c55bd6374c?w=300&auto=format&fit=crop&q=80', desc: 'Soft comfy chairs for home or room' }
    ];

    // ============================================================
    // 2. FETCH PRODUCTS FROM API
    // ============================================================
    
    async function fetchProducts() {
        try {
            const response = await fetch('/api/products');
            if (!response.ok) throw new Error('Failed to fetch');
            allProducts = await response.json();
            isLoading = false;
            
            // Map API products to match frontend structure
            allProducts = allProducts.map(product => ({
                id: 'shop-' + product.id,
                brand: product.category || 'Generic',
                feature: 'Standard',
                rating: 4.5,
                stars: 4,
                price: parseFloat(product.price),
                originalPrice: parseFloat(product.price) * 1.2 || null,
                orders: Math.floor(Math.random() * 200) + 50,
                freeShipping: Math.random() > 0.5,
                img: product.image || 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=300&auto=format&fit=crop&q=80',
                desc: product.description || 'Great product!',
                name: product.name,
                category: product.category
            }));
            
            syncFiltersFromInputs();
            renderProducts();
            updateProductCount(allProducts.length);
        } catch (error) {
            console.error('Error fetching products:', error);
            isLoading = false;
            document.getElementById('shopProductsContainer').innerHTML = `
                <div style="text-align:center;padding:40px;color:red;">
                    <h3>Failed to load products</h3>
                    <p>Please refresh the page</p>
                </div>
            `;
        }
    }

    // ============================================================
    // 3. HELPER FUNCTIONS
    // ============================================================
    
    function showToast(message, type = 'success') {
        const toastContainer = document.getElementById('toastContainer');
        if (!toastContainer) return;
        const toast = document.createElement('div');
        toast.className = `toast ${type}`;
        toast.innerHTML = `<span>${message}</span>`;
        toastContainer.appendChild(toast);
        setTimeout(() => toast.remove(), 3000);
    }

    function filterProducts() {
        if (isLoading) return [];
        return allProducts.filter(product => {
            if (activeFilters.brands.length > 0 && !activeFilters.brands.includes(product.brand)) return false;
            if (activeFilters.features.length > 0 && !activeFilters.features.includes(product.feature)) return false;
            if (activeFilters.ratings.length > 0 && !activeFilters.ratings.includes(product.stars)) return false;
            if (activeFilters.minPrice !== null && product.price < activeFilters.minPrice) return false;
            if (activeFilters.maxPrice !== null && product.price > activeFilters.maxPrice) return false;
            return true;
        });
    }

    function sortProducts(products, sortBy) {
        const sorted = [...products];
        if (sortBy === 'price-low') sorted.sort((a, b) => a.price - b.price);
        else if (sortBy === 'price-high') sorted.sort((a, b) => b.price - a.price);
        else if (sortBy === 'rating') sorted.sort((a, b) => b.rating - a.rating);
        return sorted;
    }

    function paginateProducts(products) {
        const start = (currentPage - 1) * itemsPerPage;
        return products.slice(start, start + itemsPerPage);
    }

    function updateProductCount(count) {
        const countElem = document.getElementById('productCount');
        if (countElem) countElem.textContent = count;
    }

    // ============================================================
    // 4. RENDER PRODUCTS
    // ============================================================
    
    function renderProducts() {
        if (isLoading) {
            document.getElementById('shopProductsContainer').innerHTML = 
                `<div style="text-align:center;padding:40px;">Loading products...</div>`;
            return;
        }
        
        let filtered = filterProducts();
        updateProductCount(filtered.length);
        
        const sortBy = document.getElementById('desktopSortSelect')?.value || 'featured';
        filtered = sortProducts(filtered, sortBy);
        
        const paginated = paginateProducts(filtered);
        const container = document.getElementById('shopProductsContainer');
        
        if (paginated.length === 0) {
            container.innerHTML = `<div style="text-align: center; padding: 40px;"><h3>No products match selected filters</h3></div>`;
            return;
        }
        
        container.innerHTML = paginated.map(product => {
            const starsHTML = Array.from({ length: 5 }, (_, i) => i < product.stars ? '★' : '☆').join('');
            const originalPriceHTML = product.originalPrice ? `<span class="shop-price-original">$${product.originalPrice.toFixed(2)}</span>` : '';
            const freeShippingHTML = (product.freeShipping && currentLayout === 'list') ? `<p class="free-shipping-tag">Free Shipping</p>` : '';
            const ordersHTML = currentLayout === 'list' ? `<span class="list-orders-meta">${product.orders} orders</span>` : '';
            const title = currentLayout === 'list' ? product.name : product.name;
            
            return `
                <div class="shop-product-card" data-id="${product.id}" onclick="window.location.href='/product/${product.id}'" style="cursor:pointer;">
                    <button class="wishlist-toggle-btn" data-id="${product.id}" onclick="event.stopPropagation();">
                        <svg viewBox="0 0 24 24" width="18" height="18"><path fill="currentColor" d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                    </button>
                    <div class="shop-img-wrapper">
                        <img src="${product.img}" alt="${product.brand} product">
                    </div>
                    <div class="shop-info-block">
                        <div class="shop-price-row">
                            <span class="shop-price">$${product.price.toFixed(2)}</span>
                            ${originalPriceHTML}
                        </div>
                        <div class="shop-rating-row">
                            <div class="rating-stars">${starsHTML}</div>
                            <span class="rating-num">${product.rating}</span>
                            ${ordersHTML}
                        </div>
                        <h3 class="shop-product-title">${title}</h3>
                        <p class="list-description">${product.desc}</p>
                        ${freeShippingHTML}
                    </div>
                </div>
            `;
        }).join('');
        
        updatePaginationButtons(filtered.length);
    }
    
    function updatePaginationButtons(totalItems) {
        const totalPages = Math.ceil(totalItems / itemsPerPage);
        const paginationDiv = document.getElementById('paginationControls');
        if (!paginationDiv) return;
        
        if (totalPages <= 1) {
            paginationDiv.innerHTML = `<button class="page-btn" data-page="prev">&lt;</button><button class="page-btn active" data-page="1">1</button><button class="page-btn" data-page="next">&gt;</button>`;
            return;
        }
        
        let buttons = `<button class="page-btn" data-page="prev">&lt;</button>`;
        for (let i = 1; i <= Math.min(totalPages, 5); i++) {
            buttons += `<button class="page-btn ${currentPage === i ? 'active' : ''}" data-page="${i}">${i}</button>`;
        }
        buttons += `<button class="page-btn" data-page="next">&gt;</button>`;
        paginationDiv.innerHTML = buttons;
    }
    
    // ============================================================
    // 5. LAYOUT SWITCHING
    // ============================================================
    
    function applyLayoutToContainer() {
        const container = document.getElementById('shopProductsContainer');
        if (!container) return;
        if (currentLayout === 'list') {
            container.classList.add('list-view');
        } else {
            container.classList.remove('list-view');
        }
    }
    
    function updateLayoutButtons() {
        const gridBtn = document.getElementById('gridLayoutBtn');
        const listBtn = document.getElementById('listLayoutBtn');
        const mobileGridBtn = document.getElementById('mobileGridBtn');
        const mobileListBtn = document.getElementById('mobileListBtn');
        
        if (gridBtn && listBtn) {
            if (currentLayout === 'grid') {
                gridBtn.classList.add('active');
                listBtn.classList.remove('active');
            } else {
                gridBtn.classList.remove('active');
                listBtn.classList.add('active');
            }
        }
        
        if (mobileGridBtn && mobileListBtn) {
            if (currentLayout === 'grid') {
                mobileGridBtn.classList.add('active');
                mobileListBtn.classList.remove('active');
            } else {
                mobileGridBtn.classList.remove('active');
                mobileListBtn.classList.add('active');
            }
        }
    }
    
    function checkWidthAndSetLayout() {
        const windowWidth = window.innerWidth;
        let newLayout = currentLayout;
        
        if (windowWidth <= 700) {
            newLayout = 'list';
        } else {
            if (currentLayout !== 'list') newLayout = 'grid';
        }
        
        if (newLayout !== currentLayout) {
            currentLayout = newLayout;
            applyLayoutToContainer();
            updateLayoutButtons();
            renderProducts();
        }
    }
    
    function setLayout(layout) {
        currentLayout = layout;
        applyLayoutToContainer();
        updateLayoutButtons();
        renderProducts();
        showToast(currentLayout === 'grid' ? 'Grid View' : 'List View');
    }
    
    // ============================================================
    // 6. FILTERS & ACTIVE TAGS
    // ============================================================
    
    function syncFiltersFromInputs() {
        activeFilters.brands = Array.from(document.querySelectorAll('.brand-filter-chk:checked')).map(chk => chk.value);
        activeFilters.features = Array.from(document.querySelectorAll('.feature-filter-chk:checked')).map(chk => chk.value);
        activeFilters.ratings = Array.from(document.querySelectorAll('.rating-filter-chk:checked')).map(chk => parseInt(chk.value));
        
        const verifiedCheckbox = document.getElementById('verifiedOnlyCheckbox');
        if (verifiedCheckbox) activeFilters.verifiedOnly = verifiedCheckbox.checked;
        
        renderActiveTags();
        currentPage = 1;
        renderProducts();
    }
    
    function renderActiveTags() {
        const tagsRow = document.getElementById('activeTagsRow');
        if (!tagsRow) return;
        
        let tags = [];
        activeFilters.brands.forEach(b => tags.push(`<span class="active-tag" data-filter="brand" data-value="${b}">${b} <span class="active-tag-close">&times;</span></span>`));
        activeFilters.features.forEach(f => tags.push(`<span class="active-tag" data-filter="feature" data-value="${f}">${f} <span class="active-tag-close">&times;</span></span>`));
        activeFilters.ratings.forEach(r => tags.push(`<span class="active-tag" data-filter="rating" data-value="${r}">${r} star <span class="active-tag-close">&times;</span></span>`));
        
        if (activeFilters.minPrice !== null || activeFilters.maxPrice !== null) {
            const minText = activeFilters.minPrice !== null ? `$${activeFilters.minPrice}` : 'Any';
            const maxText = activeFilters.maxPrice !== null ? `$${activeFilters.maxPrice}` : 'Any';
            tags.push(`<span class="active-tag" data-filter="price">${minText}-${maxText} <span class="active-tag-close">&times;</span></span>`);
        }
        
        tags.push(`<span class="clear-tags-btn" id="clearAllTagsBtn">Clear all filter</span>`);
        tagsRow.innerHTML = tags.join('');
        
        document.querySelectorAll('.active-tag-close').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const tag = btn.closest('.active-tag');
                const filterType = tag.dataset.filter;
                const value = tag.dataset.value;
                
                if (filterType === 'brand') {
                    const chk = Array.from(document.querySelectorAll('.brand-filter-chk')).find(c => c.value === value);
                    if (chk) chk.checked = false;
                } else if (filterType === 'feature') {
                    const chk = Array.from(document.querySelectorAll('.feature-filter-chk')).find(c => c.value === value);
                    if (chk) chk.checked = false;
                } else if (filterType === 'rating') {
                    const chk = Array.from(document.querySelectorAll('.rating-filter-chk')).find(c => c.value === value);
                    if (chk) chk.checked = false;
                } else if (filterType === 'price') {
                    activeFilters.minPrice = null;
                    activeFilters.maxPrice = null;
                    if (document.getElementById('minPriceInput')) document.getElementById('minPriceInput').value = '';
                    if (document.getElementById('maxPriceInput')) document.getElementById('maxPriceInput').value = '';
                }
                syncFiltersFromInputs();
            });
        });
        
        const clearBtn = document.getElementById('clearAllTagsBtn');
        if (clearBtn) {
            clearBtn.addEventListener('click', () => {
                document.querySelectorAll('.brand-filter-chk, .feature-filter-chk, .rating-filter-chk').forEach(c => c.checked = false);
                activeFilters.minPrice = null;
                activeFilters.maxPrice = null;
                if (document.getElementById('minPriceInput')) document.getElementById('minPriceInput').value = '';
                if (document.getElementById('maxPriceInput')) document.getElementById('maxPriceInput').value = '';
                syncFiltersFromInputs();
                showToast('Cleared all filters');
            });
        }
    }
    
    // ============================================================
    // 7. CART FUNCTIONS
    // ============================================================
    
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
    
    function addToCart(productId) {
        const product = allProducts.find(p => p.id === productId);
        if (!product) return;
        
        const existingItem = cart.find(item => item.id === productId);
        if (existingItem) {
            existingItem.quantity += 1;
        } else {
            cart.push({
                id: productId,
                name: product.name || product.brand + ' Device',
                price: product.price,
                img: product.img,
                quantity: 1
            });
        }
        
        localStorage.setItem('brand_cart', JSON.stringify(cart));
        updateCartCount();
        renderCart();
        showToast(`Added "${product.name}" to cart!`);
    }
    
    function removeFromCart(productId) {
        const index = cart.findIndex(item => item.id === productId);
        if (index > -1) {
            const name = cart[index].name;
            cart.splice(index, 1);
            localStorage.setItem('brand_cart', JSON.stringify(cart));
            updateCartCount();
            renderCart();
            showToast(`Removed "${name}" from cart`);
        }
    }
    
    // ============================================================
    // 8. EVENT LISTENERS
    // ============================================================
    
    // Layout buttons
    document.getElementById('gridLayoutBtn')?.addEventListener('click', () => setLayout('grid'));
    document.getElementById('listLayoutBtn')?.addEventListener('click', () => setLayout('list'));
    document.getElementById('mobileGridBtn')?.addEventListener('click', () => setLayout('grid'));
    document.getElementById('mobileListBtn')?.addEventListener('click', () => setLayout('list'));
    
    // Filter checkboxes
    document.querySelectorAll('.brand-filter-chk, .feature-filter-chk, .rating-filter-chk').forEach(input => {
        input.addEventListener('change', syncFiltersFromInputs);
    });
    
    // Price filter
    document.getElementById('applyPriceFilterBtn')?.addEventListener('click', () => {
        const min = parseFloat(document.getElementById('minPriceInput')?.value);
        const max = parseFloat(document.getElementById('maxPriceInput')?.value);
        activeFilters.minPrice = isNaN(min) ? null : min;
        activeFilters.maxPrice = isNaN(max) ? null : max;
        syncFiltersFromInputs();
        showToast('Applied price filter');
    });
    
    // Sort dropdown
    document.getElementById('desktopSortSelect')?.addEventListener('change', () => renderProducts());
    
    // Per page select
    document.getElementById('perPageSelect')?.addEventListener('change', (e) => {
        itemsPerPage = parseInt(e.target.value);
        currentPage = 1;
        renderProducts();
    });
    
    // Pagination
    document.getElementById('paginationControls')?.addEventListener('click', (e) => {
        const btn = e.target.closest('.page-btn');
        if (!btn) return;
        const page = btn.dataset.page;
        const totalItems = filterProducts().length;
        const totalPages = Math.ceil(totalItems / itemsPerPage);
        
        if (page === 'prev') { if (currentPage > 1) currentPage--; }
        else if (page === 'next') { if (currentPage < totalPages) currentPage++; }
        else { currentPage = parseInt(page); }
        renderProducts();
    });
    
    // ============================================================
    // CART - DIRECT TO CART PAGE
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
    
    // Wishlist button
    document.getElementById('shopProductsContainer')?.addEventListener('click', (e) => {
        const btn = e.target.closest('.wishlist-toggle-btn');
        if (btn) {
            e.stopPropagation();
            btn.classList.toggle('active');
            showToast(btn.classList.contains('active') ? 'Added to Wishlist' : 'Removed from Wishlist');
        }
    });
    
    // Cart remove item
    document.getElementById('cartItemsList')?.addEventListener('click', (e) => {
        if (e.target.classList.contains('cart-item-remove')) {
            removeFromCart(e.target.dataset.id);
        }
    });
    
    // Checkout button
    document.getElementById('checkoutBtn')?.addEventListener('click', () => {
        window.location.href = '/cart';
    });
    
    // Newsletter form
    document.getElementById('newsletterForm')?.addEventListener('submit', (e) => {
        e.preventDefault();
        const email = document.getElementById('newsletterEmail')?.value;
        if (email) {
            showToast(`Thank you! "${email}" has been subscribed.`);
            e.target.reset();
        }
    });
    
    // Mobile filter drawer
    const mobileFilterToggle = document.getElementById('mobileFilterToggleBtn');
    const mobileFiltersDrawer = document.getElementById('mobileFiltersDrawer');
    const mobileFiltersClose = document.getElementById('mobileFiltersClose');
    const applyMobileFilters = document.getElementById('applyMobileFiltersBtn');
    const filterSidebar = document.getElementById('filterSidebar');
    const mobileSidebarOverlay = document.getElementById('mobileSidebarOverlay');
    
    mobileFilterToggle?.addEventListener('click', () => {
        const filterCard = filterSidebar?.querySelector('.filter-sidebar');
        const mountPoint = document.getElementById('mobileFiltersBodyMount');
        if (filterCard && mountPoint && mountPoint.children.length === 0) {
            mountPoint.appendChild(filterCard);
        }
        if (mobileFiltersDrawer) mobileFiltersDrawer.style.right = '0';
        if (mobileSidebarOverlay) mobileSidebarOverlay.style.display = 'block';
        document.body.style.overflow = 'hidden';
    });
    
    function closeMobileFilters() {
        const filterCard = document.getElementById('mobileFiltersBodyMount')?.querySelector('.filter-sidebar');
        if (filterCard && filterSidebar && filterSidebar.children.length === 0) {
            filterSidebar.appendChild(filterCard);
        }
        if (mobileFiltersDrawer) mobileFiltersDrawer.style.right = '-280px';
        if (mobileSidebarOverlay) mobileSidebarOverlay.style.display = 'none';
        document.body.style.overflow = '';
    }
    
    mobileFiltersClose?.addEventListener('click', closeMobileFilters);
    applyMobileFilters?.addEventListener('click', () => {
        syncFiltersFromInputs();
        closeMobileFilters();
    });
    mobileSidebarOverlay?.addEventListener('click', closeMobileFilters);
    
    // Mobile sort button
    document.getElementById('mobileSortBtn')?.addEventListener('click', () => {
        showToast('Sorting Newest selected (Mobile)');
    });
    
    // Mobile menu sidebar
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const mobileSidebar = document.getElementById('mobileSidebar');
    const mobileSidebarClose = document.getElementById('mobileSidebarClose');
    
    mobileMenuBtn?.addEventListener('click', () => {
        if (mobileSidebar) mobileSidebar.classList.add('open');
        if (mobileSidebarOverlay) mobileSidebarOverlay.style.display = 'block';
        document.body.style.overflow = 'hidden';
    });
    
    mobileSidebarClose?.addEventListener('click', () => {
        if (mobileSidebar) mobileSidebar.classList.remove('open');
        if (mobileSidebarOverlay) mobileSidebarOverlay.style.display = 'none';
        document.body.style.overflow = '';
    });
    
    // Category dropdown
    const navCategoriesMenuBtn = document.getElementById('navCategoriesMenuBtn');
    const navDropdownMenu = document.getElementById('navDropdownMenu');
    
    navCategoriesMenuBtn?.addEventListener('click', (e) => {
        e.stopPropagation();
        navDropdownMenu?.classList.toggle('show');
    });
    
    document.addEventListener('click', () => {
        navDropdownMenu?.classList.remove('show');
    });
    
    // You may also like
    const youMayAlsoLikeContainer = document.getElementById('youMayAlsoLikeContainer');
    if (youMayAlsoLikeContainer) {
        youMayAlsoLikeContainer.innerHTML = youMayAlsoLike.map(item => `
            <div class="recommended-card" onclick="window.location.href='/product/${item.id}'" style="cursor:pointer;">
                <div class="rec-img-wrapper">
                    <img src="${item.img}" alt="${item.name}">
                </div>
                <div class="rec-details">
                    <p class="rec-price">$${item.price.toFixed(2)}</p>
                    <p class="rec-desc">${item.desc}</p>
                </div>
            </div>
        `).join('');
    }
    
// Search functionality - Dynamic from API
const searchInput = document.getElementById('searchInput');
const searchSuggestions = document.getElementById('searchSuggestions');

searchInput?.addEventListener('input', async function() {
    const query = this.value.toLowerCase().trim();
    if (!query) {
        if (searchSuggestions) searchSuggestions.style.display = 'none';
        return;
    }
    
    try {
        // API route use karo - `/api/products/search/query`
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
    }
});

searchSuggestions?.addEventListener('click', (e) => {
    const item = e.target.closest('.suggestion-item');
    if (item && item.dataset.id) {
        window.location.href = `/product/${item.dataset.id}`;
    }
});

document.addEventListener('click', (e) => {
    if (searchInput && !searchInput.contains(e.target) && searchSuggestions && !searchSuggestions.contains(e.target)) {
        searchSuggestions.style.display = 'none';
    }
});
    
    // ============================================================
    // 9. INITIALIZE
    // ============================================================
    
    // Filter accordions
    document.querySelectorAll('.filter-group-title').forEach(title => {
        title.addEventListener('click', function() {
            this.classList.toggle('collapsed');
            const body = this.nextElementSibling;
            if (body) {
                body.classList.toggle('collapsed');
                if (body.classList.contains('collapsed')) {
                    body.style.maxHeight = '0px';
                } else {
                    body.style.maxHeight = body.scrollHeight + 'px';
                }
            }
        });
    });
    
    document.querySelectorAll('.filter-body').forEach(body => {
        if (body.classList.contains('collapsed')) {
            body.style.maxHeight = '0px';
        } else {
            body.style.maxHeight = body.scrollHeight + 'px';
        }
    });
    
    // Initial load - Fetch products from API
    fetchProducts();
    
    // Cart initialization
    updateCartCount();
    renderCart();
    checkWidthAndSetLayout();
    
    // Resize handler
    let resizeTimer;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
            checkWidthAndSetLayout();
        }, 150);
    });
});