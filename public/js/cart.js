// Brand E-Commerce Portal - Cart Page Logic
document.addEventListener('DOMContentLoaded', () => {

    /* ==========================================================================
       1. STATE MANAGEMENT & INITIALIZATION
       ========================================================================== */
    let cart = JSON.parse(localStorage.getItem('brand_cart')) || [];
    let savedLater = JSON.parse(localStorage.getItem('brand_saved_later')) || [];

    if (cart.length === 0) {
        cart = [
            { id: 'deal-1', name: 'Smart Watch Sport Series', price: 75.00, img: 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=300&auto=format&fit=crop&q=80', quantity: 1 },
            { id: 'deal-4', name: 'Hi-Fi Wireless Headphones', price: 90.00, img: 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=300&auto=format&fit=crop&q=80', quantity: 2 }
        ];
        localStorage.setItem('brand_cart', JSON.stringify(cart));
    }

    if (savedLater.length === 0) {
        savedLater = [
            { id: 'shop-1', name: 'GoPro HERO6 4K Action Camera', price: 99.50, img: 'https://images.unsplash.com/photo-1502920917128-1da500764c6e?w=300&auto=format&fit=crop&q=80' },
            { id: 'shop-2', name: 'Regular Fit Resort Shirt', price: 19.00, img: 'https://images.unsplash.com/photo-1521572267360-ee0c2909d518?w=300&auto=format&fit=crop&q=80' }
        ];
        localStorage.setItem('brand_saved_later', JSON.stringify(savedLater));
    }

    let appliedCoupon = localStorage.getItem('brand_applied_coupon') || null;
    let couponDiscountPercent = appliedCoupon === 'BRAND20' ? 20 : 0;

    if (appliedCoupon === 'BRAND20') {
        const couponInput = document.getElementById('couponInput');
        if (couponInput) { couponInput.value = 'BRAND20'; couponInput.disabled = true; }
        const applyBtn = document.getElementById('couponApplyBtn');
        if (applyBtn) { applyBtn.textContent = 'Applied'; applyBtn.disabled = true; }
    }

    /* ==========================================================================
       2. DOM REFERENCES
       ========================================================================== */
    const cartPageItemsWrapper = document.getElementById('cartPageItemsWrapper');
    const cartPageEmptyState = document.getElementById('cartPageEmptyState');
    const cartPageFooterActions = document.getElementById('cartPageFooterActions');
    const cartPageTitleHeader = document.getElementById('cartPageTitleHeader');
    const savedLaterItemsGrid = document.getElementById('savedLaterItemsGrid');

    const summarySubtotal = document.getElementById('summarySubtotal');
    const summaryDiscount = document.getElementById('summaryDiscount');
    const summaryTax = document.getElementById('summaryTax');
    const summaryTotal = document.getElementById('summaryTotal');

    const cartCountBadge = document.getElementById('cartCountBadge');
    const cartDrawerCount = document.getElementById('cartDrawerCount');

    // Mobile summary elements
    const cartMobileSummaryBlock = document.getElementById('cartMobileSummaryBlock');
    const mobSummaryItemsLabel = document.getElementById('mobSummaryItemsLabel');
    const mobSummaryItems = document.getElementById('mobSummaryItems');
    const mobSummaryShipping = document.getElementById('mobSummaryShipping');
    const mobSummaryTax = document.getElementById('mobSummaryTax');
    const mobSummaryTotal = document.getElementById('mobSummaryTotal');
    const cartMobileCheckoutBtn = document.getElementById('cartMobileCheckoutBtn');

    /* ==========================================================================
       3. HELPER FUNCTIONS
       ========================================================================== */
    function updateHeaderBadges() {
        const totalCount = cart.reduce((sum, item) => sum + item.quantity, 0);
        if (cartCountBadge) cartCountBadge.textContent = totalCount;
        if (cartDrawerCount) cartDrawerCount.textContent = totalCount;
    }

    function calculateAndRenderSummary() {
        const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
        const itemCount = cart.reduce((sum, item) => sum + item.quantity, 0);

        // Desktop summary
        if (summarySubtotal) summarySubtotal.textContent = `$${subtotal.toFixed(2)}`;
        if (summaryDiscount) summaryDiscount.textContent = `-$${subtotal > 0 ? Math.min(60, subtotal).toFixed(2) : '0.00'}`;
        if (summaryTax) summaryTax.textContent = `+$${subtotal > 0 ? '7.00' : '0.00'}`;
        if (summaryTotal) summaryTotal.textContent = `$${Math.max(0, subtotal - Math.min(60, subtotal) + (subtotal > 0 ? 7 : 0)).toFixed(2)}`;

        // Mobile summary
        if (cartMobileSummaryBlock) {
            if (cart.length > 0) {
                cartMobileSummaryBlock.style.display = 'block';
                if (mobSummaryItemsLabel) mobSummaryItemsLabel.textContent = `Items (${itemCount}):`;
                if (mobSummaryItems) mobSummaryItems.textContent = `$${subtotal.toFixed(2)}`;
                if (mobSummaryShipping) mobSummaryShipping.textContent = `$${subtotal > 0 ? '10.00' : '0.00'}`;
                if (mobSummaryTax) mobSummaryTax.textContent = `$${subtotal > 0 ? '7.00' : '0.00'}`;
                if (mobSummaryTotal) mobSummaryTotal.textContent = `$${Math.max(0, subtotal - Math.min(60, subtotal) + (subtotal > 0 ? 17 : 0)).toFixed(2)}`;
                if (cartMobileCheckoutBtn) cartMobileCheckoutBtn.textContent = `Checkout (${itemCount} items)`;
            } else {
                cartMobileSummaryBlock.style.display = 'none';
            }
        }
    }

    /* ==========================================================================
       4. RENDER FUNCTIONS
       ========================================================================== */
    function renderCartPage() {
        updateHeaderBadges();

        if (cart.length === 0) {
            if (cartPageEmptyState) cartPageEmptyState.style.display = 'flex';
            if (cartPageFooterActions) cartPageFooterActions.style.display = 'none';
            if (cartPageTitleHeader) cartPageTitleHeader.textContent = 'My cart (0)';
            if (cartPageItemsWrapper) {
                cartPageItemsWrapper.innerHTML = `
                    <div class="cart-empty-state">
                        <svg viewBox="0 0 24 24" width="64" height="64"><path fill="#bdc3c7" d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.08-.14.12-.31.12-.48 0-.55-.45-1-1-1H5.21l-.94-2H1zm16 16c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z"/></svg>
                        <p class="cart-empty-text">Your shopping cart is empty</p>
                        <a href="/products" class="btn btn-blue btn-sm cart-empty-btn">Shop Now</a>
                    </div>
                `;
            }
            calculateAndRenderSummary();
            return;
        }

        if (cartPageEmptyState) cartPageEmptyState.style.display = 'none';
        if (cartPageFooterActions) cartPageFooterActions.style.display = 'flex';

        const cartCount = cart.reduce((sum, item) => sum + item.quantity, 0);
        if (cartPageTitleHeader) cartPageTitleHeader.textContent = `My cart (${cartCount})`;

        if (cartPageItemsWrapper) {
            cartPageItemsWrapper.innerHTML = cart.map(item => `
                <div class="cart-item-row" data-id="${item.id}">
                    <div class="cart-item-thumb">
                        <img src="${item.img}" alt="${item.name}">
                    </div>
                    <div class="cart-item-desc-col">
                        <a href="/product/${item.id}" class="cart-item-title">${item.name}</a>
                        <span class="cart-item-spec-text">Size: Regular, Color: Default, Seller: Brand Marketplace</span>
                        <div class="cart-item-actions-row">
                            <button class="cart-item-action-link remove btn-remove-item" data-id="${item.id}">Remove</button>
                            <button class="cart-item-action-link save-later btn-save-later" data-id="${item.id}">Save for later</button>
                        </div>
                    </div>
                    <div class="cart-item-qty-price-col">
                        <span class="cart-item-row-price">$${(item.price * item.quantity).toFixed(2)}</span>
                        <select class="cart-item-qty-select select-qty-dropdown" data-id="${item.id}">
                            ${[1,2,3,4,5,6,7,8,9,10].map(q => `
                                <option value="${q}" ${item.quantity === q ? 'selected' : ''}>Qty: ${q}</option>
                            `).join('')}
                        </select>
                    </div>
                    <div class="cart-item-bottom-row">
                        <div class="mobile-qty-adjuster">
                            <button class="mobile-qty-btn btn-qty-minus" data-id="${item.id}">−</button>
                            <input type="text" class="mobile-qty-input" value="${item.quantity}" readonly>
                            <button class="mobile-qty-btn btn-qty-plus" data-id="${item.id}">+</button>
                        </div>
                        <span class="cart-item-mobile-price">$${(item.price * item.quantity).toFixed(2)}</span>
                    </div>
                </div>
            `).join('');
        }

        calculateAndRenderSummary();
    }

    function renderSavedLater() {
        if (!savedLaterItemsGrid) return;

        if (savedLater.length === 0) {
            savedLaterItemsGrid.innerHTML = `
                <div class="saved-later-empty">
                    <span>Your wishlist is empty. Items you save will appear here.</span>
                </div>
            `;
            return;
        }

        savedLaterItemsGrid.innerHTML = savedLater.map(item => `
            <div class="saved-later-card" data-id="${item.id}">
                <div class="saved-img-box">
                    <img src="${item.img}" alt="${item.name}">
                </div>
                <div class="saved-later-card-info">
                    <span class="saved-price">$${item.price.toFixed(2)}</span>
                    <span class="saved-title">${item.name}</span>
                    <div class="saved-later-actions">
                        <button class="btn-move-cart btn-move-to-cart" data-id="${item.id}">Move to cart</button>
                        <button class="btn-remove-saved" data-id="${item.id}">Remove</button>
                    </div>
                </div>
            </div>
        `).join('');
    }

    /* ==========================================================================
       5. EVENT LISTENERS
       ========================================================================== */
    document.getElementById('cartPageClearAllBtn')?.addEventListener('click', () => {
        if (confirm('Remove all items from cart?')) {
            cart = [];
            localStorage.setItem('brand_cart', JSON.stringify(cart));
            renderCartPage();
            renderSavedLater();
            showToast('Cart cleared', 'success');
        }
    });

    cartPageItemsWrapper?.addEventListener('change', (e) => {
        if (e.target.classList.contains('select-qty-dropdown')) {
            const id = e.target.dataset.id;
            const val = parseInt(e.target.value);
            const item = cart.find(i => i.id === id);
            if (item) {
                item.quantity = val;
                localStorage.setItem('brand_cart', JSON.stringify(cart));
                renderCartPage();
                showToast(`Quantity updated to ${val}`, 'success');
            }
        }
    });

    cartPageItemsWrapper?.addEventListener('click', (e) => {
        const id = e.target.dataset.id;
        if (!id) return;

        if (e.target.classList.contains('btn-qty-minus')) {
            const item = cart.find(i => i.id === id);
            if (item) {
                if (item.quantity > 1) {
                    item.quantity--;
                    localStorage.setItem('brand_cart', JSON.stringify(cart));
                    renderCartPage();
                } else {
                    cart = cart.filter(i => i.id !== id);
                    localStorage.setItem('brand_cart', JSON.stringify(cart));
                    renderCartPage();
                    showToast('Removed item', 'success');
                }
            }
        }

        if (e.target.classList.contains('btn-qty-plus')) {
            const item = cart.find(i => i.id === id);
            if (item) {
                if (item.quantity < 10) {
                    item.quantity++;
                    localStorage.setItem('brand_cart', JSON.stringify(cart));
                    renderCartPage();
                } else {
                    showToast('Maximum quantity is 10', 'warning');
                }
            }
        }

        if (e.target.classList.contains('btn-remove-item')) {
            const item = cart.find(i => i.id === id);
            if (item) {
                cart = cart.filter(i => i.id !== id);
                localStorage.setItem('brand_cart', JSON.stringify(cart));
                renderCartPage();
                showToast(`Removed "${item.name}"`, 'success');
            }
        }

        if (e.target.classList.contains('btn-save-later')) {
            const itemIndex = cart.findIndex(i => i.id === id);
            if (itemIndex > -1) {
                const item = cart[itemIndex];
                cart.splice(itemIndex, 1);
                localStorage.setItem('brand_cart', JSON.stringify(cart));
                if (!savedLater.some(s => s.id === id)) {
                    savedLater.push({ id: item.id, name: item.name, price: item.price, img: item.img });
                    localStorage.setItem('brand_saved_later', JSON.stringify(savedLater));
                }
                renderCartPage();
                renderSavedLater();
                showToast('Saved for later', 'success');
            }
        }
    });

    savedLaterItemsGrid?.addEventListener('click', (e) => {
        const btn = e.target.closest('.btn-move-to-cart');
        const removeBtn = e.target.closest('.btn-remove-saved');

        if (btn) {
            const id = btn.dataset.id;
            const index = savedLater.findIndex(s => s.id === id);
            if (index > -1) {
                const item = savedLater[index];
                savedLater.splice(index, 1);
                localStorage.setItem('brand_saved_later', JSON.stringify(savedLater));
                const cartItem = cart.find(c => c.id === id);
                if (cartItem) { cartItem.quantity += 1; }
                else { cart.push({ id: item.id, name: item.name, price: item.price, img: item.img, quantity: 1 }); }
                localStorage.setItem('brand_cart', JSON.stringify(cart));
                renderCartPage();
                renderSavedLater();
                showToast('Moved to cart', 'success');
            }
        }

        if (removeBtn) {
            const id = removeBtn.dataset.id;
            const index = savedLater.findIndex(s => s.id === id);
            if (index > -1) {
                const item = savedLater[index];
                savedLater.splice(index, 1);
                localStorage.setItem('brand_saved_later', JSON.stringify(savedLater));
                renderSavedLater();
                showToast('Removed from saved', 'success');
            }
        }
    });

    /* ==========================================================================
       6. COUPON
       ========================================================================== */
    const couponInput = document.getElementById('couponInput');
    const couponApplyBtn = document.getElementById('couponApplyBtn');

    couponApplyBtn?.addEventListener('click', () => {
        if (!couponInput) return;
        const code = couponInput.value.trim().toUpperCase();
        if (code === 'BRAND20') {
            if (appliedCoupon === 'BRAND20') { showToast('Coupon already applied!', 'warning'); return; }
            appliedCoupon = 'BRAND20';
            couponDiscountPercent = 20;
            localStorage.setItem('brand_applied_coupon', 'BRAND20');
            couponInput.disabled = true;
            couponApplyBtn.textContent = 'Applied';
            couponApplyBtn.disabled = true;
            calculateAndRenderSummary();
            showToast('Coupon applied! 20% off', 'success');
        } else if (code === '') {
            showToast('Enter a coupon code', 'warning');
        } else {
            showToast('Invalid coupon code', 'danger');
        }
    });

    /* ==========================================================================
       7. CHECKOUT
       ========================================================================== */
    function handleCheckout() {
        if (cart.length === 0) {
            showToast('Cart is empty', 'warning');
            return;
        }

        const overlay = document.createElement('div');
        overlay.style.cssText = `
            position:fixed;top:0;left:0;width:100vw;height:100vh;
            background:rgba(15,23,42,0.6);backdrop-filter:blur(12px);
            z-index:2000;display:flex;align-items:center;justify-content:center;
            opacity:0;transition:opacity 0.4s ease;
        `;

        const card = document.createElement('div');
        card.style.cssText = `
            background:white;border-radius:12px;padding:40px;max-width:460px;width:90%;
            text-align:center;display:flex;flex-direction:column;align-items:center;gap:20px;
            transform:scale(0.9);transition:transform 0.4s cubic-bezier(0.34,1.56,0.64,1);
        `;
        card.innerHTML = `
            <div style="width:80px;height:80px;background:rgba(46,204,113,0.15);color:#2ecc71;border-radius:50%;display:flex;align-items:center;justify-content:center;">
                <svg viewBox="0 0 24 24" width="48" height="48"><path fill="currentColor" d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
            </div>
            <h2 style="font-size:26px;font-weight:700;">Order Placed!</h2>
            <p style="color:#666;font-size:15px;">Thank you for shopping with us!</p>
            <div style="font-weight:600;color:#0d6efd;font-size:14px;">
                Redirecting in <span id="redirectTimer">5</span> seconds...
            </div>
        `;

        overlay.appendChild(card);
        document.body.appendChild(overlay);
        setTimeout(() => { overlay.style.opacity = '1'; card.style.transform = 'scale(1)'; }, 10);

        cart = [];
        localStorage.removeItem('brand_cart');
        localStorage.removeItem('brand_applied_coupon');
        appliedCoupon = null;
        couponDiscountPercent = 0;

        let count = 5;
        const timerSpan = document.getElementById('redirectTimer');
        const interval = setInterval(() => {
            count--;
            if (timerSpan) timerSpan.textContent = count;
            if (count <= 0) {
                clearInterval(interval);
                overlay.style.opacity = '0';
                card.style.transform = 'scale(0.9)';
                setTimeout(() => { overlay.remove(); window.location.href = '/'; }, 400);
            }
        }, 1000);
    }

    document.getElementById('summaryCheckoutBtn')?.addEventListener('click', handleCheckout);
    document.getElementById('cartMobileCheckoutBtn')?.addEventListener('click', handleCheckout);

    /* ==========================================================================
       8. TOAST
       ========================================================================== */
    const toastContainer = document.getElementById('toastContainer');

    function showToast(message, type = 'success') {
        if (!toastContainer) return;
        const toast = document.createElement('div');
        toast.className = `toast ${type}`;
        let icon = `<svg viewBox="0 0 24 24" width="20" height="20"><path fill="#2ecc71" d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>`;
        if (type === 'danger') icon = `<svg viewBox="0 0 24 24" width="20" height="20"><path fill="#fd4f5b" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>`;
        if (type === 'warning') icon = `<svg viewBox="0 0 24 24" width="20" height="20"><path fill="#ff9017" d="M1 21h22L12 2 1 21zm12-3h-2v-2h2v2zm0-4h-2v-4h2v4z"/></svg>`;
        toast.innerHTML = `${icon}<span>${message}</span>`;
        toastContainer.appendChild(toast);
        setTimeout(() => {
            toast.style.animation = 'toastSlideIn 0.3s cubic-bezier(0.4,0,0.2,1) reverse';
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }

    /* ==========================================================================
       9. INITIAL RENDER
       ========================================================================== */
    renderCartPage();
    renderSavedLater();

});