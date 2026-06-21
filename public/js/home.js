// Brand E-Commerce Portal Javascript Functionality

document.addEventListener('DOMContentLoaded', () => {

  /* ==========================================================================
     1. STATE MANAGEMENT (Cart, Search, Products Database)
     ========================================================================== */
  let cart = JSON.parse(localStorage.getItem('brand_cart')) || [];
  
  /* ==========================================================================
     2. COUNTDOWN TIMER
     ========================================================================== */
  let timerEndTime = localStorage.getItem('brand_timer_end');
  
  if (!timerEndTime) {
    const totalDuration = (4 * 24 * 60 * 60 + 13 * 60 * 60 + 34 * 60 + 56) * 1000;
    timerEndTime = Date.now() + totalDuration;
    localStorage.setItem('brand_timer_end', timerEndTime);
  } else {
    timerEndTime = parseInt(timerEndTime);
    if (timerEndTime < Date.now()) {
      timerEndTime = Date.now() + (24 * 60 * 60 * 1000);
      localStorage.setItem('brand_timer_end', timerEndTime);
    }
  }

  function updateTimer() {
    const timeRemaining = timerEndTime - Date.now();
    
    if (timeRemaining <= 0) {
      timerEndTime = Date.now() + (24 * 60 * 60 * 1000);
      localStorage.setItem('brand_timer_end', timerEndTime);
      return;
    }

    const days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
    const hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

    const timerDays = document.getElementById('timerDays');
    const timerHours = document.getElementById('timerHours');
    const timerMins = document.getElementById('timerMins');
    const timerSecs = document.getElementById('timerSecs');

    if (timerDays) timerDays.textContent = days.toString().padStart(2, '0');
    if (timerHours) timerHours.textContent = hours.toString().padStart(2, '0');
    if (timerMins) timerMins.textContent = minutes.toString().padStart(2, '0');
    if (timerSecs) timerSecs.textContent = seconds.toString().padStart(2, '0');
  }

  updateTimer();
  setInterval(updateTimer, 1000);

  /* ==========================================================================
     3. NAVIGATION DROPDOWNS & SIDEBAR
     ========================================================================== */
  
  const navCategoriesMenuBtn = document.getElementById('navCategoriesMenuBtn');
  const navDropdownMenu = document.getElementById('navDropdownMenu');

  if (navCategoriesMenuBtn) {
    navCategoriesMenuBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      navDropdownMenu.classList.toggle('show');
    });
  }

  document.addEventListener('click', () => {
    if (navDropdownMenu && navDropdownMenu.classList.contains('show')) {
      navDropdownMenu.classList.remove('show');
    }
  });

  // Mobile sidebar
  const mobileMenuBtn = document.getElementById('mobileMenuBtn');
  const mobileSidebar = document.getElementById('mobileSidebar');
  const mobileSidebarOverlay = document.getElementById('mobileSidebarOverlay');
  const mobileSidebarClose = document.getElementById('mobileSidebarClose');

  function openMobileSidebar() {
    if (mobileSidebar) mobileSidebar.classList.add('open');
    if (mobileSidebarOverlay) mobileSidebarOverlay.style.display = 'block';
    document.body.style.overflow = 'hidden';
  }

  function closeMobileSidebar() {
    if (mobileSidebar) mobileSidebar.classList.remove('open');
    if (mobileSidebarOverlay) mobileSidebarOverlay.style.display = 'none';
    document.body.style.overflow = '';
  }

  if (mobileMenuBtn) mobileMenuBtn.addEventListener('click', openMobileSidebar);
  if (mobileSidebarClose) mobileSidebarClose.addEventListener('click', closeMobileSidebar);
  if (mobileSidebarOverlay) mobileSidebarOverlay.addEventListener('click', closeMobileSidebar);

  if (mobileSidebar) {
    mobileSidebar.querySelectorAll('a').forEach(item => {
      item.addEventListener('click', closeMobileSidebar);
    });
  }

  // Sidebar category highlights
  const sidebarItems = document.querySelectorAll('.sidebar-item');
  sidebarItems.forEach(item => {
    item.addEventListener('click', function() {
      sidebarItems.forEach(i => i.classList.remove('active'));
      this.classList.add('active');
    });
  });

  /* ==========================================================================
     4. SEARCH SUGGESTIONS - DYNAMIC FROM API
     ========================================================================== */
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
        window.location.href = '/product/' + productId;
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
        window.location.href = '/products?search=' + encodeURIComponent(query);
      }
    });
  }

  /* ==========================================================================
     5. PRODUCT DETAIL - REDIRECT TO PAGE
     ========================================================================== */
  const productDetailModal = document.getElementById('productDetailModal');
  const modalCloseBtn = document.getElementById('modalCloseBtn');

  function closeProductDetailsModal() {
    if (productDetailModal) productDetailModal.classList.remove('open');
  }

  if (modalCloseBtn) modalCloseBtn.addEventListener('click', closeProductDetailsModal);
  
  if (productDetailModal) {
    productDetailModal.addEventListener('click', (e) => {
      if (e.target === productDetailModal) {
        closeProductDetailsModal();
      }
    });
  }

  // Product card click - redirect to product page
  document.body.addEventListener('click', (e) => {
    const card = e.target.closest('.product-action-card');
    if (!card) return;
    
    e.preventDefault();
    const productId = card.dataset.id;
    if (productId) {
      window.location.href = '/product/' + productId;
    }
  });

  /* ==========================================================================
     6. SHOPPING CART - DIRECT TO CART PAGE
     ========================================================================== */
  const cartToggleBtn = document.getElementById('cartToggleBtn');
  const cartDrawer = document.getElementById('cartDrawer');
  const cartCloseBtn = document.getElementById('cartCloseBtn');
  const cartOverlay = document.getElementById('cartOverlay');
  const cartCountBadge = document.getElementById('cartCountBadge');
  const cartDrawerCount = document.getElementById('cartDrawerCount');
  
  const cartEmptyState = document.getElementById('cartEmptyState');
  const cartItemsList = document.getElementById('cartItemsList');
  const cartDrawerFooter = document.getElementById('cartDrawerFooter');
  const cartSubtotalValue = document.getElementById('cartSubtotalValue');

  // DIRECT TO CART PAGE
  if (cartToggleBtn) {
    cartToggleBtn.addEventListener('click', (e) => {
      e.preventDefault();
      window.location.href = '/cart';
    });
  }

  // Close cart drawer functions (kept for compatibility)
  function closeCartDrawer() {
    if (cartDrawer) cartDrawer.classList.remove('open');
    if (cartOverlay) cartOverlay.style.display = 'none';
    document.body.style.overflow = '';
  }

  if (cartCloseBtn) cartCloseBtn.addEventListener('click', closeCartDrawer);
  if (cartOverlay) cartOverlay.addEventListener('click', closeCartDrawer);

  function updateCartCount() {
    const totalCount = cart.reduce((sum, item) => sum + item.quantity, 0);
    if (cartCountBadge) cartCountBadge.textContent = totalCount;
    if (cartDrawerCount) cartDrawerCount.textContent = totalCount;
  }

  function renderCart() {
    updateCartCount();
    
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

  // Remove items in drawer
  if (cartItemsList) {
    cartItemsList.addEventListener('click', (e) => {
      if (e.target.classList.contains('cart-item-remove')) {
        const productId = e.target.dataset.id;
        removeFromCart(productId);
      }
    });
  }

  // Checkout redirect
  const checkoutBtn = document.getElementById('checkoutBtn');
  if (checkoutBtn) {
    checkoutBtn.addEventListener('click', () => {
      window.location.href = '/cart';
    });
  }

  function removeFromCart(productId) {
    const index = cart.findIndex(item => item.id === productId);
    if (index > -1) {
      const name = cart[index].name;
      cart.splice(index, 1);
      localStorage.setItem('brand_cart', JSON.stringify(cart));
      updateCartCount();
      renderCart();
      showToast(`Removed "${name}" from cart`, 'success');
    }
  }

  // Initialize cart
  updateCartCount();

  /* ==========================================================================
     7. TOAST NOTIFICATIONS
     ========================================================================== */
  const toastContainer = document.getElementById('toastContainer');

  function showToast(message, type = 'success') {
    if (!toastContainer) return;
    const toast = document.createElement('div');
    toast.className = `toast ${type}`;
    toast.innerHTML = `
      <svg viewBox="0 0 24 24" width="20" height="20"><path fill="#2ecc71" d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
      <span>${message}</span>
    `;
    
    toastContainer.appendChild(toast);
    
    setTimeout(() => {
      toast.style.animation = 'toastSlideIn 0.3s cubic-bezier(0.4, 0, 0.2, 1) reverse';
      setTimeout(() => {
        toast.remove();
      }, 300);
    }, 3000);
  }

  /* ==========================================================================
     8. INQUIRY FORM
     ========================================================================== */
  const supplierInquiryForm = document.getElementById('supplierInquiryForm');
  const mobileInquiryBtn = document.getElementById('mobileInquiryBtn');
  const inquiryCardContainer = document.getElementById('inquiryCardContainer');
  
  if (supplierInquiryForm) {
    supplierInquiryForm.addEventListener('submit', (e) => {
      e.preventDefault();
      
      const itemName = document.getElementById('inquiryItem')?.value.trim();
      const details = document.getElementById('inquiryDetails')?.value.trim();
      const qty = document.getElementById('inquiryQuantity')?.value;
      const unit = document.getElementById('inquiryUnit')?.value;

      if (!itemName || !details || !qty) return;

      showToast(`Inquiry sent successfully for ${qty} ${unit} of "${itemName}"!`, 'success');
      
      supplierInquiryForm.reset();

      if (inquiryCardContainer && inquiryCardContainer.classList.contains('open-mobile')) {
        inquiryCardContainer.classList.remove('open-mobile');
        if (mobileSidebarOverlay) mobileSidebarOverlay.style.display = 'none';
        document.body.style.overflow = '';
      }
    });
  }

  if (mobileInquiryBtn) {
    mobileInquiryBtn.addEventListener('click', () => {
      if (inquiryCardContainer) inquiryCardContainer.classList.add('open-mobile');
      if (mobileSidebarOverlay) mobileSidebarOverlay.style.display = 'block';
      document.body.style.overflow = 'hidden';
    });
  }

  if (mobileSidebarOverlay) {
    mobileSidebarOverlay.addEventListener('click', () => {
      if (inquiryCardContainer && inquiryCardContainer.classList.contains('open-mobile')) {
        inquiryCardContainer.classList.remove('open-mobile');
        mobileSidebarOverlay.style.display = 'none';
        document.body.style.overflow = '';
      }
    });
  }

  /* ==========================================================================
     9. EXTRA TRIGGERS
     ========================================================================== */
  document.body.addEventListener('click', (e) => {
    const btn = e.target.closest('.category-source-btn');
    if (btn) {
      e.preventDefault();
      const category = btn.dataset.category;
      showToast(`Requesting source directory for ${category}...`, 'success');
    }
  });

  document.body.addEventListener('click', (e) => {
    const btn = e.target.closest('.modal-trigger-btn');
    if (btn) {
      e.preventDefault();
      showToast('Trending Electronic Catalog loaded!', 'success');
    }
  });

  document.querySelectorAll('.auth-btn').forEach(btn => {
    btn.addEventListener('click', function() {
      const action = this.dataset.action;
      if (action === 'join') {
        showToast('Opening registration console... (Simulated)', 'success');
      } else {
        showToast('Opening login terminal... (Simulated)', 'success');
      }
    });
  });

  // Newsletter
  const newsletterForm = document.getElementById('newsletterForm');
  if (newsletterForm) {
    newsletterForm.addEventListener('submit', (e) => {
      e.preventDefault();
      const email = document.getElementById('newsletterEmail')?.value.trim();
      if (email) {
        showToast(`Thank you! "${email}" has been subscribed.`, 'success');
        newsletterForm.reset();
      }
    });
  }

  // Sidebar categories redirect to products page
  document.querySelectorAll('.sidebar-item').forEach(item => {
    item.addEventListener('click', (e) => {
      if (item.textContent.trim().toLowerCase().includes('more category')) return;
      e.preventDefault();
      window.location.href = '/products';
    });
  });
});