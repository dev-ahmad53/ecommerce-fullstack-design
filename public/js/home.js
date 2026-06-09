// Brand E-Commerce Portal Javascript Functionality

document.addEventListener('DOMContentLoaded', () => {

  /* ==========================================================================
     1. STATE MANAGEMENT (Cart, Search, Products Database)
     ========================================================================== */
  let cart = JSON.parse(localStorage.getItem('brand_cart')) || [];
  
  // Mock product catalog for modals and search suggestions
  const productCatalog = {
    // Deals
    'deal-1': { name: 'Smart Watch Sport Series', price: 75.00, img: 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=300&auto=format&fit=crop&q=80', desc: 'Premium fitness tracking smartwatch with heart rate monitor, sleep analysis, and GPS tracking. Waterproof rating IP68. Battery life up to 7 days.' },
    'deal-2': { name: 'Pro Laptop Pro 15', price: 899.00, img: 'https://images.unsplash.com/photo-1496181130204-7552cc14f1d0?w=300&auto=format&fit=crop&q=80', desc: 'Powerful work laptop featuring 16GB RAM, 512GB SSD, Intel Core i7 processor, and stunning 15.6 inch IPS display. Perfect for developers and creatives.' },
    'deal-3': { name: 'Action Camera 4K', price: 120.00, img: 'https://images.unsplash.com/photo-1502920917128-1da500764c6e?w=300&auto=format&fit=crop&q=80', desc: 'Ultra HD action camera. Shoots 4K at 60fps. Built-in stabilization, waterproof casing, and dual screens. Includes mounting accessory pack.' },
    'deal-4': { name: 'Hi-Fi Wireless Headphones', price: 90.00, img: 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=300&auto=format&fit=crop&q=80', desc: 'Over-ear active noise cancelling headphones. Hi-res audio support, 40 hours playtime, and pressure-relieving ear pads for supreme comfort.' },
    'deal-5': { name: 'DSLR Professional Camera', price: 450.00, img: 'https://images.unsplash.com/photo-1516035069371-29a1b244cc32?w=300&auto=format&fit=crop&q=80', desc: 'Professional level DSLR camera bundle. 24.1 MP sensor, high-speed autofocus, full HD video recording, and Wi-Fi connectivity.' },
    
    // Home and Outdoor
    'ho-1': { name: 'Premium Soft Chair', price: 19.00, img: 'https://images.unsplash.com/photo-1567538096630-e0c55bd6374c?w=300&auto=format&fit=crop&q=80', desc: 'Ergonomic soft-cushioned lounge chair. Perfect accent piece for living rooms, studies, or bedrooms. Sturdy wooden legs.' },
    'ho-2': { name: 'Classic Sofa Set', price: 39.00, img: 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=300&auto=format&fit=crop&q=80', desc: 'Premium velvet upholstered sofa. Seats up to three comfortably. High-density foam seating with sleek metal frames.' },
    'ho-3': { name: 'Kitchen Ceramic Dishes', price: 10.00, img: 'https://images.unsplash.com/photo-1610701596007-11502861dcfa?w=300&auto=format&fit=crop&q=80', desc: '16-piece stoneware dinnerware set. Scratch resistant, dishwasher and microwave safe. Elegant modern matte glaze finish.' },
    'ho-4': { name: 'Smart Watch Tracker', price: 19.00, img: 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=300&auto=format&fit=crop&q=80', desc: 'Casual everyday smartwatch featuring basic notification sync, step tracking, and alarm clocks.' },
    'ho-5': { name: 'High-speed Kitchen Mixer', price: 85.00, img: 'https://images.unsplash.com/photo-1578643463396-0997cb5328c1?w=300&auto=format&fit=crop&q=80', desc: 'Professional stand mixer with 5-quart stainless steel bowl, 6 speeds, and 3 attachment heads (dough hook, beater, whisk).' },
    'ho-6': { name: 'Professional Food Blender', price: 39.00, img: 'https://images.unsplash.com/photo-1570222094114-d054a817e56b?w=300&auto=format&fit=crop&q=80', desc: 'High capacity countertop blender. Crucial for smoothies, purees, and crushing ice. Easy-clean BPA-free pitcher.' },
    'ho-7': { name: 'Modern Home Toaster', price: 19.00, img: 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=300&auto=format&fit=crop&q=80', desc: '2-slot stainless steel toaster. Features multiple browning levels, bagel mode, and removable crumb tray.' },
    'ho-8': { name: 'Espresso Coffee Maker', price: 15.00, img: 'https://images.unsplash.com/photo-1517256064527-09c53b2d0bc6?w=300&auto=format&fit=crop&q=80', desc: 'Personal drip espresso maker. Rapid heating tech, reusable mesh filter, and insulated travel mug included.' },
    
    // Consumer Electronics
    'el-1': { name: 'Fitness Smartwatch V2', price: 19.00, img: 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=300&auto=format&fit=crop&q=80', desc: 'Affordable fitness band featuring step counters, heart monitors, and sleep notifications.' },
    'el-2': { name: 'Compact Action Camera', price: 19.00, img: 'https://images.unsplash.com/photo-1502920917128-1da500764c6e?w=300&auto=format&fit=crop&q=80', desc: 'Mini action cam. Snaps photos and basic video. Splashproof, portable size with clip attachments.' },
    'el-3': { name: 'Studio Sound Headphones', price: 19.00, img: 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=300&auto=format&fit=crop&q=80', desc: 'Wired over-ear studio headphones. Balanced soundstage, soft foam cushions, long coil wire.' },
    'el-4': { name: 'Elegant Smart Watch Gold', price: 22.00, img: 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=300&auto=format&fit=crop&q=80', desc: 'Stylish smartwatch with metallic gold bezel. Features step trackers, custom clock dials, and call reminders.' },
    'el-5': { name: 'Pro Console Gaming Set', price: 34.00, img: 'https://images.unsplash.com/photo-1612287230202-1bf1d85d1bdf?w=300&auto=format&fit=crop&q=80', desc: 'Durable console controllers bundle. High response times, custom grip triggers, and vibration feedback.' },
    'el-6': { name: 'Ultra Book Laptop PC', price: 340.00, img: 'https://images.unsplash.com/photo-1496181130204-7552cc14f1d0?w=300&auto=format&fit=crop&q=80', desc: 'Thin and light notebook PC. 8GB RAM, 256GB SSD storage, Intel Core i3. Ideal for school work, writing, and web browsing.' },
    'el-7': { name: 'Slim Smartphone Android', price: 19.00, img: 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=300&auto=format&fit=crop&q=80', desc: 'Basic budget Android smartphone. Large 6.2 inch screen, quad-core processor, expandable storage card.' },
    'el-8': { name: 'Glass Electric Kettle', price: 10.00, img: 'https://images.unsplash.com/photo-1594228135964-943f25d905aa?w=300&auto=format&fit=crop&q=80', desc: '1.7L capacity glass electric water kettle. Rapid boil system, automatic shut-off safety feature, blue LED heat indicators.' },
    
    // Recommended items
    'rec-1': { name: "Modern Men's Blue Polo", price: 10.30, img: 'https://images.unsplash.com/photo-1521572267360-ee0c2909d518?w=300&auto=format&fit=crop&q=80', desc: 'Classic fit cotton polo shirt for men. Breathable piquè fabric, ribbed collar, and double button placket.' },
    'rec-2': { name: 'Winter Parka Jacket', price: 10.30, img: 'https://images.unsplash.com/photo-1591195853828-11db59a44f6b?w=300&auto=format&fit=crop&q=80', desc: 'Heavy duty insulated winter parka. Faux-fur trim hood, water resistant shell, multiple functional pockets.' },
    'rec-3': { name: 'Sleek Winter Suit Jacket', price: 12.50, img: 'https://images.unsplash.com/photo-1593032465175-481ac7f401a0?w=300&auto=format&fit=crop&q=80', desc: 'Single-breasted men’s wool blazer. Modern slim silhouette, patch pockets, perfect for casual and formal wear.' },
    'rec-4': { name: 'Leather Office Travel Bag', price: 34.00, img: 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=300&auto=format&fit=crop&q=80', desc: 'Full grain leather travel duffle bag. Expandable compartments, heavy duty brass hardware, and shoulder strap.' },
    'rec-5': { name: 'Premium Casual Backpack', price: 99.00, img: 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=300&auto=format&fit=crop&q=80', desc: 'Genuine leather designer rucksack backpack. Laptop sleeve, front buckle straps, and padded back mesh support.' },
    'rec-6': { name: "Men's Fitted Shorts", price: 9.99, img: 'https://images.unsplash.com/photo-1591195853828-11db59a44f6b?w=300&auto=format&fit=crop&q=80', desc: 'Stretch denim shorts for men. Five pocket styling, sits comfortably above the knee, durable wash.' },
    'rec-7': { name: 'Wireless Headset Pro', price: 8.99, img: 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=300&auto=format&fit=crop&q=80', desc: 'Gaming headset with flexible omnidirectional microphone, deep bass drivers, and LED glow effects.' },
    'rec-8': { name: 'Compact Leather Clutch', price: 10.30, img: 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=300&auto=format&fit=crop&q=80', desc: 'Elegant small leather pouch. Features zippered pockets, wrist loop strap, and card slot linings.' },
    'rec-9': { name: 'Handcrafted Clay Pot', price: 10.30, img: 'https://images.unsplash.com/photo-1612196808214-b8e1d6145a8c?w=300&auto=format&fit=crop&q=80', desc: 'Artisanal earthenware storage pot. Handmade from organic red clay, perfect for water storage or shelf decor.' },
    'rec-10': { name: 'Steel Electric Thermos Kettle', price: 80.95, img: 'https://images.unsplash.com/photo-1594228135964-943f25d905aa?w=300&auto=format&fit=crop&q=80', desc: 'Dual-wall vacuum insulated hot water dispenser. Keeps water boiling or piping hot for hours, simple push-pour tab.' }
  };



  /* ==========================================================================
     3. REPEATING COUNTDOWN TIMER
     ========================================================================== */
  // Sets standard 4 days 13 hours 34 min 56 sec or restores ticking countdown
  let timerEndTime = localStorage.getItem('brand_timer_end');
  
  if (!timerEndTime) {
    const totalDuration = (4 * 24 * 60 * 60 + 13 * 60 * 60 + 34 * 60 + 56) * 1000;
    timerEndTime = Date.now() + totalDuration;
    localStorage.setItem('brand_timer_end', timerEndTime);
  } else {
    timerEndTime = parseInt(timerEndTime);
    if (timerEndTime < Date.now()) { // If expired, renew to another 24 hours
      timerEndTime = Date.now() + (24 * 60 * 60 * 1000);
      localStorage.setItem('brand_timer_end', timerEndTime);
    }
  }

  function updateTimer() {
    const timeRemaining = timerEndTime - Date.now();
    
    if (timeRemaining <= 0) {
      // Reset timer
      timerEndTime = Date.now() + (24 * 60 * 60 * 1000);
      localStorage.setItem('brand_timer_end', timerEndTime);
      return;
    }

    const days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
    const hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

    document.getElementById('timerDays').textContent = days.toString().padStart(2, '0');
    document.getElementById('timerHours').textContent = hours.toString().padStart(2, '0');
    document.getElementById('timerMins').textContent = minutes.toString().padStart(2, '0');
    document.getElementById('timerSecs').textContent = seconds.toString().padStart(2, '0');
  }

  updateTimer();
  setInterval(updateTimer, 1000);

  /* ==========================================================================
     4. NAVIGATION DROPDOWNS & SIDEBAR (Mobile & Desktop)
     ========================================================================== */
  
  // All Category Navigation Menu (Desktop Header)
  const navCategoriesMenuBtn = document.getElementById('navCategoriesMenuBtn');
  const navDropdownMenu = document.getElementById('navDropdownMenu');

  navCategoriesMenuBtn.addEventListener('click', (e) => {
    e.stopPropagation();
    navDropdownMenu.classList.toggle('show');
  });

  document.addEventListener('click', () => {
    if (navDropdownMenu.classList.contains('show')) {
      navDropdownMenu.classList.remove('show');
    }
  });

  // Mobile navigation drawer toggle
  const mobileMenuBtn = document.getElementById('mobileMenuBtn');
  const mobileSidebar = document.getElementById('mobileSidebar');
  const mobileSidebarOverlay = document.getElementById('mobileSidebarOverlay');
  const mobileSidebarClose = document.getElementById('mobileSidebarClose');

  function openMobileSidebar() {
    mobileSidebar.classList.add('open');
    mobileSidebarOverlay.style.display = 'block';
    document.body.style.overflow = 'hidden';
  }

  function closeMobileSidebar() {
    mobileSidebar.classList.remove('open');
    mobileSidebarOverlay.style.display = 'none';
    document.body.style.overflow = '';
  }

  mobileMenuBtn.addEventListener('click', openMobileSidebar);
  mobileSidebarClose.addEventListener('click', closeMobileSidebar);
  mobileSidebarOverlay.addEventListener('click', closeMobileSidebar);

  // Close sidebar on menu item click
  mobileSidebar.querySelectorAll('a').forEach(item => {
    item.addEventListener('click', closeMobileSidebar);
  });

  // Category selection highlights
  const sidebarItems = document.querySelectorAll('.sidebar-item');
  sidebarItems.forEach(item => {
    item.addEventListener('click', function() {
      sidebarItems.forEach(i => i.classList.remove('active'));
      this.classList.add('active');
    });
  });

  /* ==========================================================================
     5. SEARCH SUGGESTIONS INTERACTIVITY
     ========================================================================== */
  const searchInput = document.getElementById('searchInput');
  const searchSuggestions = document.getElementById('searchSuggestions');
  const globalSearchForm = document.getElementById('globalSearchForm');

  searchInput.addEventListener('input', function() {
    const query = this.value.toLowerCase().trim();
    if (!query) {
      searchSuggestions.style.display = 'none';
      return;
    }

    // Filter products from catalog matching query
    const matches = Object.keys(productCatalog).filter(id => {
      return productCatalog[id].name.toLowerCase().includes(query);
    });

    if (matches.length === 0) {
      searchSuggestions.innerHTML = `<div class="suggestion-item">No results found for "${query}"</div>`;
    } else {
      searchSuggestions.innerHTML = matches.slice(0, 5).map(id => {
        const prod = productCatalog[id];
        return `
          <div class="suggestion-item" data-id="${id}">
            <img class="suggestion-thumb" src="${prod.img}" alt="${prod.name}">
            <span>${prod.name}</span>
          </div>
        `;
      }).join('');
    }
    
    searchSuggestions.style.display = 'block';
  });

  // Click suggestion to view details
  searchSuggestions.addEventListener('click', (e) => {
    const item = e.target.closest('.suggestion-item');
    if (!item) return;
    const productId = item.dataset.id;
    if (productId) {
      searchInput.value = productCatalog[productId].name;
      searchSuggestions.style.display = 'none';
      openProductDetailsModal(productId);
    }
  });

  // Hide search suggestions on document click
  document.addEventListener('click', (e) => {
    if (!searchInput.contains(e.target) && !searchSuggestions.contains(e.target)) {
      searchSuggestions.style.display = 'none';
    }
  });

  globalSearchForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const query = searchInput.value.trim();
    if (query) {
      window.location.href = `shop.html?q=${encodeURIComponent(query)}`;
    }
  });

  /* ==========================================================================
     6. PRODUCT DETAIL MODAL SYSTEM
     ========================================================================== */
  const productDetailModal = document.getElementById('productDetailModal');
  const modalDetailsContent = document.getElementById('modalDetailsContent');
  const modalCloseBtn = document.getElementById('modalCloseBtn');

  function openProductDetailsModal(productId) {
    const product = productCatalog[productId];
    if (!product) return;

    modalDetailsContent.innerHTML = `
      <div class="modal-img-container">
        <img src="${product.img}" alt="${product.name}">
      </div>
      <div class="modal-info">
        <h3 class="modal-info-title">${product.name}</h3>
        <p class="modal-info-price">$${product.price.toFixed(2)}</p>
        <p class="modal-info-desc">${product.desc}</p>
        <button class="btn btn-blue btn-full add-to-cart-btn" id="modalAddToCartBtn" data-id="${productId}" style="margin-bottom: 8px;">
          Add to Cart
        </button>
        <a href="product.html?id=${productId}" class="btn btn-white btn-full" style="text-align: center; display: flex; align-items: center; justify-content: center;">
          View Full Details
        </a>
      </div>
    `;

    productDetailModal.classList.add('open');
  }

  function closeProductDetailsModal() {
    productDetailModal.classList.remove('open');
  }

  modalCloseBtn.addEventListener('click', closeProductDetailsModal);
  
  // Close modal when clicking on overlay background
  productDetailModal.addEventListener('click', (e) => {
    if (e.target === productDetailModal) {
      closeProductDetailsModal();
    }
  });

  // Trigger modal from product cards
  document.body.addEventListener('click', (e) => {
    const card = e.target.closest('.product-action-card');
    if (!card) return;
    
    e.preventDefault();
    const productId = card.dataset.id;
    if (productId) {
      openProductDetailsModal(productId);
    }
  });

  // Handle Add to Cart button inside Modal
  modalDetailsContent.addEventListener('click', (e) => {
    const btn = e.target.closest('#modalAddToCartBtn');
    if (!btn) return;
    
    const productId = btn.dataset.id;
    if (productId) {
      addToCart(productId);
      closeProductDetailsModal();
    }
  });

  /* ==========================================================================
     7. SHOPPING CART SYSTEM
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

  function openCartDrawer() {
    renderCart();
    cartDrawer.classList.add('open');
    cartOverlay.style.display = 'block';
    document.body.style.overflow = 'hidden';
  }

  function closeCartDrawer() {
    cartDrawer.classList.remove('open');
    cartOverlay.style.display = 'none';
    document.body.style.overflow = '';
  }

  cartToggleBtn.addEventListener('click', (e) => {
    e.preventDefault();
    openCartDrawer();
  });

  cartCloseBtn.addEventListener('click', closeCartDrawer);
  cartOverlay.addEventListener('click', closeCartDrawer);

  function addToCart(productId) {
    const product = productCatalog[productId];
    if (!product) return;

    // Check if product is already in cart
    const existingItem = cart.find(item => item.id === productId);
    if (existingItem) {
      existingItem.quantity += 1;
    } else {
      cart.push({
        id: productId,
        name: product.name,
        price: product.price,
        img: product.img,
        quantity: 1
      });
    }

    localStorage.setItem('brand_cart', JSON.stringify(cart));
    updateCartCount();
    showToast(`Added "${product.name}" to cart!`, 'success');
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

  function updateCartCount() {
    const totalCount = cart.reduce((sum, item) => sum + item.quantity, 0);
    cartCountBadge.textContent = totalCount;
    cartDrawerCount.textContent = totalCount;
  }

  function renderCart() {
    updateCartCount();
    
    if (cart.length === 0) {
      cartEmptyState.style.display = 'flex';
      cartItemsList.style.display = 'none';
      cartDrawerFooter.style.display = 'none';
      return;
    }

    cartEmptyState.style.display = 'none';
    cartItemsList.style.display = 'flex';
    cartDrawerFooter.style.display = 'block';

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

    // Compute Subtotal
    const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    cartSubtotalValue.textContent = `$${subtotal.toFixed(2)}`;
  }

  // Remove items in drawer listener
  cartItemsList.addEventListener('click', (e) => {
    if (e.target.classList.contains('cart-item-remove')) {
      const productId = e.target.dataset.id;
      removeFromCart(productId);
    }
  });

  // Proceed checkout redirect click
  document.getElementById('checkoutBtn').addEventListener('click', () => {
    window.location.href = 'cart.html';
  });

  // Initialize cart quantities
  updateCartCount();

  /* ==========================================================================
     8. TOAST NOTIFICATIONS UTILITY
     ========================================================================== */
  const toastContainer = document.getElementById('toastContainer');

  function showToast(message, type = 'success') {
    const toast = document.createElement('div');
    toast.className = `toast ${type}`;
    toast.innerHTML = `
      <svg viewBox="0 0 24 24" width="20" height="20"><path fill="#2ecc71" d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
      <span>${message}</span>
    `;
    
    toastContainer.appendChild(toast);
    
    // Auto remove toast
    setTimeout(() => {
      toast.style.animation = 'toastSlideIn 0.3s cubic-bezier(0.4, 0, 0.2, 1) reverse';
      setTimeout(() => {
        toast.remove();
      }, 300);
    }, 3000);
  }

  /* ==========================================================================
     9. INQUIRY FORM VALIDATION & INTERACTIVE MODAL (Mobile overlay)
     ========================================================================== */
  const supplierInquiryForm = document.getElementById('supplierInquiryForm');
  const mobileInquiryBtn = document.getElementById('mobileInquiryBtn');
  const inquiryCardContainer = document.getElementById('inquiryCardContainer');
  
  supplierInquiryForm.addEventListener('submit', (e) => {
    e.preventDefault();
    
    const itemName = document.getElementById('inquiryItem').value.trim();
    const details = document.getElementById('inquiryDetails').value.trim();
    const qty = document.getElementById('inquiryQuantity').value;
    const unit = document.getElementById('inquiryUnit').value;

    if (!itemName || !details || !qty) return;

    // Toast Success
    showToast(`Inquiry sent successfully for ${qty} ${unit} of "${itemName}"!`, 'success');
    
    // Reset form
    supplierInquiryForm.reset();

    // Close mobile popup if it was open
    if (inquiryCardContainer.classList.contains('open-mobile')) {
      inquiryCardContainer.classList.remove('open-mobile');
      mobileSidebarOverlay.style.display = 'none';
      document.body.style.overflow = '';
    }
  });

  // Inquiry popups for mobile
  mobileInquiryBtn.addEventListener('click', () => {
    inquiryCardContainer.classList.add('open-mobile');
    mobileSidebarOverlay.style.display = 'block';
    document.body.style.overflow = 'hidden';
  });

  // Click overlay closes mobile inquiry
  mobileSidebarOverlay.addEventListener('click', () => {
    if (inquiryCardContainer.classList.contains('open-mobile')) {
      inquiryCardContainer.classList.remove('open-mobile');
      mobileSidebarOverlay.style.display = 'none';
      document.body.style.overflow = '';
    }
  });

  /* ==========================================================================
     10. EXTRA TRIGGERS & PROMO CARDS (Learn more / Source now)
     ========================================================================== */
  // Handles "Source now" buttons in categories
  document.body.addEventListener('click', (e) => {
    const btn = e.target.closest('.category-source-btn');
    if (!btn) return;
    
    e.preventDefault();
    const category = btn.dataset.category;
    showToast(`Requesting source directory for ${category}...`, 'success');
  });

  // Learn more triggers
  document.body.addEventListener('click', (e) => {
    const btn = e.target.closest('.modal-trigger-btn');
    if (!btn) return;
    
    e.preventDefault();
    showToast('Trending Electronic Catalog loaded!', 'success');
  });

  // Welcome banner triggers
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

  // Newsletter Submitting validation
  const newsletterForm = document.getElementById('newsletterForm');
  newsletterForm?.addEventListener('submit', (e) => {
    e.preventDefault();
    const email = document.getElementById('newsletterEmail').value.trim();
    if (email) {
      showToast(`Thank you! "${email}" has been subscribed.`, 'success');
      newsletterForm.reset();
    }
  });

  // Redirect to shop page for sidebar categories clicks
  document.querySelectorAll('.sidebar-item').forEach(item => {
    item.addEventListener('click', (e) => {
      if (item.textContent.trim().toLowerCase().includes('more category')) return;
      e.preventDefault();
      window.location.href = 'shop.html';
    });
  });
});
