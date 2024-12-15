document.addEventListener('DOMContentLoaded', () => {
    // Restock Button Logic
    document.querySelectorAll('.restock').forEach(button => {
        button.addEventListener('click', () => {
            const productId = button.dataset.id;
            const qtyInput = button.closest('tr').querySelector('.restock-qty');
            const quantity = parseInt(qtyInput.value);

            if (!quantity || quantity <= 0) {
                alert('Please enter a valid quantity.');
                return;
            }

            updateStock('restock', productId, quantity, button, qtyInput);
        });
    });

    // Unstock Button Logic
    document.querySelectorAll('.unstock').forEach(button => {
        button.addEventListener('click', () => {
            const productId = button.dataset.id;
            updateStock('unstock', productId, 0, button);
        });
    });

    // Function to update stock via AJAX
    function updateStock(action, productId, quantity, button, qtyInput = null) {
        const formData = new FormData();
        formData.append('productId', productId);
        formData.append('action', action);
        formData.append('quantity', quantity);

        fetch('stock_handler.php', { // Use the new file
            method: 'POST',
            body: formData
        })
        .then(response => response.text()) // Plain text response
        .then(data => {
            if (data.trim() === "success") {
                alert('Stock updated successfully.');

                const stockCell = button.closest('tr').querySelector('.stock');

                if (action === 'restock') {
                    stockCell.textContent = parseInt(stockCell.textContent) + quantity;
                } else if (action === 'unstock') {
                    stockCell.textContent = 0;
                }

                // Disable and faint buttons after success
                button.disabled = true;
                button.style.backgroundColor = '#ccc';
                button.style.color = '#fff';

                if (qtyInput) qtyInput.disabled = true; // Disable quantity input
            } else {
                alert('Error: ' + data.trim());
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while updating stock.');
        });
    }
});
