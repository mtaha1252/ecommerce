document.getElementById('signupForm').addEventListener('submit', function (event) {
  event.preventDefault(); // Prevent default form submission

  const username = document.getElementById('username').value.trim();
  const email = document.getElementById('email').value.trim();
  const password = document.getElementById('password').value.trim();
  const confirmPassword = document.getElementById('confirmPassword').value.trim();

  // Validate that all fields are filled
  if (!username || !email || !password || !confirmPassword) {
    alert('Please fill out all fields.');
    return;
  }
  const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$/;

  if (!passwordRegex.test(password)) {
    alert("Password must be at least 8 characters long, contain one uppercase letter, one lowercase letter, and one special character.");
    return;
  }
  if (password !== confirmPassword) {
    alert('Passwords do not match. Please re-enter your password.');
    return;
  }

  const formData = new FormData();
  formData.append('username', username);
  formData.append('email', email);
  formData.append('password', password);
  formData.append('confirmPassword', confirmPassword);

  fetch('sign-up.php', {
    method: 'POST',
    body: formData,
  })
    .then((response) => {
      console.log(response);
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return response.json();
    })
    .then((data) => {
      console.log(data);
      if (data.success) {
        alert(data.message);
        window.location.href = 'sign-in.php';
      } else {
        alert(data.message);
      }
    })
    .catch((error) => {
      alert('Something went wrong. Please try again later.');
      console.error('Error:', error);
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

function togglePassword(event) {
  const passwordInput = event.target.previousElementSibling;
  const eyeIcon = event.target;
  
  // Toggle the input type between "password" and "text"
  if (passwordInput.type === 'password') {
    passwordInput.type = 'text';
    eyeIcon.textContent = '🙈'; // Change icon to "hide"
  } else {
    passwordInput.type = 'password';
    eyeIcon.textContent = '👁️'; // Change icon to "show"
  }
}

// Add event listeners for both eye icons
document.getElementById('eye-icon1').addEventListener('click', togglePassword);
document.getElementById('eye-icon2').addEventListener('click', togglePassword);



const passwordInput = document.getElementById('password');
const confirmPasswordInput = document.getElementById('confirmPassword');

const passwordRequirements = {
  length: document.getElementById('passwordLength'),
  lowercase: document.getElementById('passwordLowercase'),
  uppercase: document.getElementById('passwordUppercase'),
  digit: document.getElementById('passwordDigit'),
  special: document.getElementById('passwordSpecial'),
};

const confirmPasswordRequirements = {
  match: document.getElementById('confirmPasswordMatch'),
};

const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$/;

// Password validation function (for password field only)
function validatePassword(input, requirements) {
  const value = input.value;

  // Validate password length
  requirements.length.classList.toggle('valid', value.length >= 8);
  requirements.length.classList.toggle('invalid', value.length < 8);

  // Validate lowercase
  requirements.lowercase.classList.toggle('valid', /[a-z]/.test(value));
  requirements.lowercase.classList.toggle('invalid', !/[a-z]/.test(value));

  // Validate uppercase
  requirements.uppercase.classList.toggle('valid', /[A-Z]/.test(value));
  requirements.uppercase.classList.toggle('invalid', !/[A-Z]/.test(value));

  // Validate digit
  requirements.digit.classList.toggle('valid', /\d/.test(value));
  requirements.digit.classList.toggle('invalid', !/\d/.test(value));

  // Validate special character
  requirements.special.classList.toggle('valid', /[!@#$%^&*]/.test(value));
  requirements.special.classList.toggle('invalid', !/[!@#$%^&*]/.test(value));
}

// Confirm Password validation function (for confirm password field only)
function validateConfirmPassword() {
  const passwordValue = passwordInput.value;
  const confirmPasswordValue = confirmPasswordInput.value;

  // Check if confirm password matches password
  if (confirmPasswordValue === passwordValue) {
    confirmPasswordRequirements.match.classList.add('valid');
    confirmPasswordRequirements.match.classList.remove('invalid');
  } else {
    confirmPasswordRequirements.match.classList.add('invalid');
    confirmPasswordRequirements.match.classList.remove('valid');
  }
}

// Password validation for the password field
passwordInput.addEventListener('input', function() {
  validatePassword(passwordInput, passwordRequirements);
});

// Confirm Password validation for the confirm password field
confirmPasswordInput.addEventListener('input', function() {
  validateConfirmPassword();
});
