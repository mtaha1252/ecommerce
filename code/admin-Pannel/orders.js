document.querySelector('.menu-toggle').addEventListener('click', function() {
    const sidebar = document.getElementById('sidebar');
    if (sidebar.classList.contains('sidebar-open')) {
      sidebar.classList.remove('sidebar-open');
    } else {
      sidebar.classList.add('sidebar-open');
    }
  });
  
document.addEventListener("DOMContentLoaded", function () {
    const orders = [
        {
            orderId: "ORD12345",
            productId: "PROD001",
            CustID: "CUST001",
            color: "Blue",
            size: "L",
            quantity: 2,
            clientAddress: "St #1 ,Shad Bagh, LHR,Pakistan",
            specialNote: "Please deliver between 9am and 5pm.",
            orderDate: "10-10-24",
            orderStatus:"Delivered"

        },
        {
            orderId: "ORD12346",
            productId: "PROD002",
            CustID: "CUST002",
            color: "Red",
            size: "M",
            quantity: 1,
            clientAddress: "Corangy, KRH,Pakistan",
            specialNote: "Gift wrap this item.",
            orderDate: "12-10-24",
            orderStatus:"Dispatched"


        },
        {
            orderId: "ORD12347",
            productId: "PROD003",
            CustID: "CUST003",
            color: "Black",
            size: "S",
            quantity: 3,
            clientAddress: "DHA Phase III,LHR, Pakistan",
            specialNote: "Leave package at the back door.",
            orderDate: "15-10-24",
            orderStatus:"pending"

        }
    ];

    const ordersTableBody = document.querySelector("#ordersTable tbody");

    orders.forEach(order => {
        const row = document.createElement("tr");

        row.innerHTML = `
            <td>${order.orderId}</td>
            <td>${order.productId}</td>
            <td>${order.CustID}</td>
            <td>${order.color}</td>
            <td>${order.size}</td>
            <td>${order.quantity}</td>
            <td>${order.clientAddress}</td>
            <td>${order.specialNote}</td>
            <td>${order.orderDate}</td>
            <td>${order.orderStatus}</td>
        `;

        ordersTableBody.appendChild(row);
    });
});



