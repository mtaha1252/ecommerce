document.getElementById('signinForm').addEventListener('submit', function (event) {
  event.preventDefault();
  
  const email = document.getElementById('email').value;
  const password = document.getElementById('password').value;
  
  if (!email || !password) {
    alert('Please fill out both fields.');
    return;
  }

  const formData = new FormData();
  formData.append('email', email);
  formData.append('password', password);
  
  fetch('sign-in.php', {
    method: 'POST',
    body: formData
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      alert(data.message);
      window.location.href = 'main.php';
    } else {
      alert(data.message);
    }
  })
  .catch(error => {
    alert('An error occurred. Please try again.');
    console.error(error);
  });
});

document.querySelector('.policy h2').addEventListener('click', function () {
  const policyContent = document.querySelector('.policy-content');
  if (policyContent.style.display === 'none' || policyContent.style.display === '') {
    policyContent.style.display = 'block'; 
  } else {
    policyContent.style.display = 'none'; 
  }
});

let menu = document.querySelector('#menu-icon');
let navbar = document.querySelector('.navbar');

menu.onclick = () => {
  menu.classList.toggle('bx-x');
  navbar.classList.toggle('open');
};


function togglePassword() {
  const passwordInput = document.getElementById('password');
  const eyeIcon = document.getElementById('eye-icon');
  
  // Toggle the input type between "password" and "text"
  if (passwordInput.type === 'password') {
    passwordInput.type = 'text';
    eyeIcon.textContent = '🙈'; // Change icon to "hide"
  } else {
    passwordInput.type = 'password';
    eyeIcon.textContent = '👁️'; // Change icon to "show"
  }
}

// Add event listener for the eye icon
document.getElementById('eye-icon').addEventListener('click', togglePassword);
