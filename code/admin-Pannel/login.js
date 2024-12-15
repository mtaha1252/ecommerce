document.getElementById('adminLoginForm').addEventListener('submit', function (event) {
    event.preventDefault(); 
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    const errorMessage = document.getElementById('errorMessage');
  
   
    if (username === 'Areeba' && password === 'Hifza') {
      window.location.href = 'dashboard.html';}
    
    else if (username === 'Hifza' && password === 'Areeba') {
        window.location.href = 'dashboard.html';}
      
    else {
      // Display error message
      errorMessage.style.display = 'block';
      errorMessage.textContent = 'Invalid username or password';
    }
  });
  