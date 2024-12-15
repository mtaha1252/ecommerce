function loadProducts() {

    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'stock.php', true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            console.log('Backend response:', xhr.responseText); // Log the raw response for debugging
            const tableBody = document.querySelector('#productsTable tbody');
            tableBody.innerHTML = ''; // Clear existing rows

            const products = xhr.responseText.split('\n'); // Parse response
            let dataFound = false; // Flag to check if we added rows
            products.forEach(product => {
                if (product.trim() === '') return; // Skip empty lines

                const productData = product.split('|');
                if (productData.length < 3) return; // Skip invalid rows

                const [productId, productName, productStock] = productData.map(item => item.trim());
                if (!productId || !productName || isNaN(productStock)) return; // Validate data

                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${productId}</td>
                    <td>${productName}</td>
                    <td>${productStock}</td>
                    <td>
                        <button class="restock" data-id="${productId}">Restock</button>
                        <button class="unstock" data-id="${productId}">Unstock</button>
                    </td>
                `;
                tableBody.appendChild(row);
                dataFound = true;
            });

            if (!dataFound) {
                console.warn('No valid data found to display.'); // Warn if no data was added
            }

            // Attach event listeners to buttons
            document.querySelectorAll('.restock').forEach(button => {
                button.addEventListener('click', handleRestock);
            });
            document.querySelectorAll('.unstock').forEach(button => {
                button.addEventListener('click', handleUnstock);
            });
        } else {
            console.error('Failed to fetch products:', xhr.statusText);
        }
    };

    xhr.onerror = function () {
        console.error('An error occurred while fetching products.');
    };

    xhr.send();
}

document.querySelector('.menu-toggle').addEventListener('click', function () {
    const sidebar = document.getElementById('sidebar');
    if (sidebar.classList.contains('sidebar-open')) {
        sidebar.classList.remove('sidebar-open');
    } else {
        sidebar.classList.add('sidebar-open');
    }
});

