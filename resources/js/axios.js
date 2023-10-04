import axios from 'axios';
import Notiflix from 'notiflix';


// using axios for https requests
// Get the form element

const loginForm = document.getElementById('formAuthentication');

// Add a submit event listener to the form
loginForm.addEventListener('submit', (event) => {
  event.preventDefault(); // Prevent the form from submitting normally

  // Get the form data
  const formData = new FormData(loginForm);
  Notiflix.Loading.pulse('Authenticating...');

  // Make an Axios POST request to the Laravel login route
  axios
    .post('/login', formData, {
      headers: {
        'Content-Type': 'application/json',
        'Accept':' application/json'
      },
    })
    .then((response) => {
      // Handle successful login
      // Hide loading spinner
      Notiflix.Loading.remove();
      // Show success message
      Notiflix.Notify.success('Authentication successful!');

      window.location.href = '/dashboard'; // Redirect to the dashboard page
    })
    .catch((error) => {
      // Handle login error
      // Hide loading spinner
      Notiflix.Loading.remove();

      // Show error message
      Notiflix.Notify.failure('Authentication failed. Please try again.');
    });
}); 
