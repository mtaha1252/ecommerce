document.querySelector('.menu-toggle').addEventListener('click', function() {
    const sidebar = document.getElementById('sidebar');
    if (sidebar.classList.contains('sidebar-open')) {
      sidebar.classList.remove('sidebar-open');
    } else {
      sidebar.classList.add('sidebar-open');
    }
});
  
document.addEventListener('DOMContentLoaded', () => {
    const paymentsTableBody = document.querySelector('#paymentsTable tbody');
    
    const payments = [
        { id: 'TRN001',customerID:'CUST001', customer: 'Areeba', amount: 'Rs.4500', method: 'Online', date: '2024-10-15', status: 'Completed' },
        { id: 'TRN002', customerID:'CUST002', customer: 'Hifza', amount: 'Rs.1050', method: 'COD', date: '2024-10-16', status: 'Pending' },
        { id: 'TRN003', customerID:'CUST003', customer: 'Aiman', amount: 'Rs.1200', method: 'Online', date: '2024-10-17', status: 'Failed' },
    ];

    payments.forEach(payment => {
        const row = document.createElement('tr');

        row.innerHTML = `
            <td>${payment.id}</td>
            <td>${payment.customerID}</td>
            <td>${payment.customer}</td>
            <td>${payment.amount}</td>
            <td>${payment.method}</td>
            <td>${payment.date}</td>
            <td>${payment.status}</td>
        `;

        paymentsTableBody.appendChild(row);
    });
});
