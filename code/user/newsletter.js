document.getElementById('newsletter-form').addEventListener('submit', function (event) {
    event.preventDefault(); // Prevent default form submission

    const email = document.getElementById('email').value.trim();

    // Ensure email field is not empty
    if (!email) {
        alert("Please enter an email address.");
        return;
    }

    const formData = new FormData();
    formData.append('email', email);

    fetch('newsletter.php', {
        method: 'POST',
        body: formData,
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json(); // Expecting JSON from the PHP script
        })
        .then((data) => {
            if (data.success) {
                alert(data.message); // Success message
                document.getElementById('newsletter-form').reset(); // Clear the form
                document.getElementById('newsletter-popup').style.display = 'none'; // Hide popup
            } else {
                alert(data.message); // Error message
            }
        })
        .catch((error) => {
            alert('Something went wrong. Please try again later.');
            console.error('Error:', error);
        });
});

window.onload = function () {
    setTimeout(function () {
        document.getElementById('newsletter-popup').style.display = 'block';
    }, 3000); // Show popup after 3 seconds
};

function closePopup() {
    document.getElementById('newsletter-popup').style.display = 'none';
}
