document.addEventListener('DOMContentLoaded', () => {
    const customers = [
        { id: 'CUST001', name: 'Hifza Amir', email: 'hifza@gmail.com', phone: '03451678293', address: '123 Main Shahdra, LHR', shoppingHistoryUrl: 'history.html?id=CUST001' },
        { id: 'CUST002', name: 'Aiman Iftikhar', email: 'aiman@gmail.com', phone: '03211234567', address: '456 Iqbal Park, LHR', shoppingHistoryUrl: 'history.html?id=CUST002' },
        { id: 'CUST003', name: 'Riffat Ihtesham', email: 'riffat@gmail.com', phone: '03231234578', address: '789 Manawa, LHR', shoppingHistoryUrl: 'history.html?id=CUST003' },
    ];

    const customersTableBody = document.querySelector('#customersTable tbody');

    customers.forEach(customer => {
        const row = document.createElement('tr');

        row.innerHTML = `
            <td>${customer.id}</td>
            <td>${customer.name}</td>
            <td>${customer.email}</td>
            <td>${customer.phone}</td>
            <td>${customer.address}</td>
            <td><button onclick="window.location.href='${customer.shoppingHistoryUrl}'">View Shopping History</button></td>
        `;

        customersTableBody.appendChild(row);
    });
});


document.querySelector('.menu-toggle').addEventListener('click', function() {
    const sidebar = document.getElementById('sidebar');
    if (sidebar.classList.contains('sidebar-open')) {
      sidebar.classList.remove('sidebar-open');
    } else {
      sidebar.classList.add('sidebar-open');
    }
  });