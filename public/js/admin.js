// Admin Panel JavaScript

document.addEventListener('DOMContentLoaded', function() {

    // ==========================================
    // TOAST NOTIFICATIONS
    // ==========================================
    window.showToast = function(message, type = 'success') {
        const container = document.getElementById('toastContainer');
        if (!container) return;
        
        const toast = document.createElement('div');
        toast.className = `toast ${type}`;
        
        const icons = {
            success: 'fas fa-check-circle',
            danger: 'fas fa-exclamation-circle',
            warning: 'fas fa-exclamation-triangle'
        };
        
        toast.innerHTML = `
            <i class="${icons[type] || icons.success}"></i>
            <span>${message}</span>
        `;
        
        container.appendChild(toast);
        
        setTimeout(() => {
            toast.style.opacity = '0';
            toast.style.transform = 'translateX(100px)';
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    };

    // ==========================================
    // SEARCH PRODUCTS
    // ==========================================
    const searchInput = document.getElementById('searchProducts');
    if (searchInput) {
        searchInput.addEventListener('keyup', function() {
            const query = this.value.toLowerCase();
            document.querySelectorAll('#productsTableBody tr').forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(query) ? '' : 'none';
            });
        });
    }

    // ==========================================
    // ALERT AUTO CLOSE
    // ==========================================
    document.querySelectorAll('.alert').forEach(alert => {
        setTimeout(() => {
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-20px)';
            setTimeout(() => alert.remove(), 300);
        }, 5000);
    });

    // ==========================================
    // DELETE CONFIRMATION
    // ==========================================
    document.querySelectorAll('.btn-delete').forEach(btn => {
        btn.addEventListener('click', function(e) {
            if (!confirm('Are you sure you want to delete this item?')) {
                e.preventDefault();
            }
        });
    });

});