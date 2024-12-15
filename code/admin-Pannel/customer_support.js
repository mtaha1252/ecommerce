document.addEventListener('DOMContentLoaded', () => {
    const inquiriesTableBody = document.querySelector('#inquiriesTable tbody');
    const inquiryIdInput = document.getElementById('inquiryId');
    const responseInput = document.getElementById('response');
    const supportForm = document.getElementById('supportForm');

    // Fetch and load inquiries dynamically
    function loadInquiries() {
        fetch('load_inquiries.php') // Separate file for fetching data
            .then(response => response.text())
            .then(data => {
                inquiriesTableBody.innerHTML = data; // Populate table rows
                attachReplyButtons();
            })
            .catch(error => console.error('Error loading inquiries:', error));
    }

    // Attach reply button events
    function attachReplyButtons() {
        document.querySelectorAll('.reply').forEach(button => {
            button.addEventListener('click', () => {
                inquiryIdInput.value = button.dataset.id;
                responseInput.focus();
            });
        });
    }

    // Handle form submission
    supportForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData();
        formData.append('inquiry_id', inquiryIdInput.value.trim());
        formData.append('response', responseInput.value.trim());

        fetch('respond_to_inquires.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.text())
            .then(data => {
                alert(data.trim());
                loadInquiries(); // Refresh inquiries
                supportForm.reset();
            })
            .catch(error => console.error('Error submitting response:', error));
    });

    // Initial data load
    loadInquiries();
});
