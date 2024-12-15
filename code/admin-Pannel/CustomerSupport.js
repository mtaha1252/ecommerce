document.querySelector('.menu-toggle').addEventListener('click', function () {
    const sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('sidebar-open');
});

document.addEventListener('DOMContentLoaded', () => {
    const inquiriesTableBody = document.querySelector('#inquiriesTable tbody');

    // Fetch inquiries dynamically from the backend
    function loadInquiries() {
        fetch('load_inquiries.php') // Endpoint to fetch inquiries
            .then(response => response.text())
            .then(data => {
                inquiriesTableBody.innerHTML = data; // Populate the table
                attachReplyButtons(); // Re-attach button event listeners
            })
            .catch(error => console.error('Error fetching inquiries:', error));
    }

    // Attach event listeners to reply buttons
    function attachReplyButtons() {
        document.querySelectorAll('.reply').forEach(button => {
            button.addEventListener('click', function () {
                const inquiryId = this.dataset.id;
                document.getElementById('inquiryId').value = inquiryId;
            });
        });
    }

    // Submit the reply form
    document.getElementById('supportForm').addEventListener('submit', function (e) {
        e.preventDefault();
        const inquiryId = document.getElementById('inquiryId').value.trim();
        const response = document.getElementById('response').value.trim();

        if (!inquiryId || !response) {
            alert('Please fill out both fields.');
            return;
        }

        // Send the response to the server
        const formData = new FormData();
        formData.append('inquiry_id', inquiryId);
        formData.append('response', response);

        fetch('respond_to_inquiry.php', {
            method: 'POST',
            body: formData,
        })
            .then(response => response.text())
            .then(data => {
                alert(data.trim()); // Show success/error message
                loadInquiries(); // Reload table
                document.getElementById('supportForm').reset(); // Clear form
            })
            .catch(error => console.error('Error sending response:', error));
    });

    // Initial load of inquiries
    loadInquiries();
});
