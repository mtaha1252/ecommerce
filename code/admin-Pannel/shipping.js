document.querySelector('.menu-toggle').addEventListener('click', function() {
    const sidebar = document.getElementById('sidebar');
    if (sidebar.classList.contains('sidebar-open')) {
        sidebar.classList.remove('sidebar-open');
    } else {
        sidebar.classList.add('sidebar-open');
    }
});

document.addEventListener('DOMContentLoaded', () => {
    const shipments = [
        { orderId: 'ORD12345', customer: 'Areeba', address: 'St #1, Shad Bagh, LHR', shippingDate: '2024-10-10', status: 'Shipped' },
        { orderId: 'ORD12346', customer: 'Hifza', address: 'Corangy, KRH', shippingDate: '2024-10-12', status: 'In Transit' },
        { orderId: 'ORD12347', customer: 'Aiman', address: 'DHA Phase III, LHR', shippingDate: '2024-10-15', status: 'Delivered' },
    ];

    const shippingTableBody = document.querySelector('#shippingTable tbody');

    shipments.forEach(shipment => {
        const row = document.createElement('tr');

        row.innerHTML = `
            <td>${shipment.orderId}</td>
            <td>${shipment.customer}</td>
            <td>${shipment.address}</td>
            <td>${shipment.shippingDate}</td>
            <td>${shipment.status}</td>
            <td><button class="update" onclick="updateStatus('${shipment.orderId}')">Update Status</button></td>
        `;

        shippingTableBody.appendChild(row);
    });
});

function updateStatus(orderId) {
    const rows = document.querySelectorAll('#shippingTable tbody tr');
    rows.forEach(row => {
        if (row.cells[0].textContent === orderId) {
            const currentStatus = row.cells[4].textContent;
            const newStatus = prompt(`Update status for Order ID: ${orderId}`, currentStatus);
            if (newStatus) {
                row.cells[4].textContent = newStatus; // Update status
            }
        }
    });
}
