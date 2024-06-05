console.log('signin.js loaded');

const signinForm = document.getElementById('signinForm');
signinForm.addEventListener('submit', (event) => {
  event.preventDefault();
  console.log('Form submit event triggered');

  const email = document.getElementById('floatingInput').value.trim();
  const password = document.getElementById('floatingPassword').value.trim();
  console.log('Email:', email);
  console.log('Password:', password);

  if (email !== 'admin1@gmail.com' || password !== 'admin123') {
    alert('Invalid email or password');
    return; 
  }

  window.location.href = 'home.html';
});