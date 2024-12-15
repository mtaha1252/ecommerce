

    document.addEventListener('DOMContentLoaded', function () {
        // Sidebar toggle functionality
        document.querySelector('.menu-toggle').addEventListener('click', function () {
            const sidebar = document.getElementById('sidebar');
            if (sidebar.classList.contains('sidebar-open')) {
                sidebar.classList.remove('sidebar-open');
            } else {
                sidebar.classList.add('sidebar-open');
            }
        });
    
        // Optional: Basic form validation before submission
        document.getElementById('removeProductForm').addEventListener('submit', function (e) {
            const productId = document.getElementById('productIdentifier').value.trim();
            const productName = document.getElementById('productName').value.trim();
    
            // Check if both fields are empty
            if (!productId && !productName) {
                alert('Please enter either Product ID or Product Name.');
                e.preventDefault(); // Prevent form submission
            }
        });
    });
    
