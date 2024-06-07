document.addEventListener("DOMContentLoaded", function () {
  var loginError = localStorage.getItem("loginError");
  if (loginError) {
    // Display login error message
    alert(loginError);
    // Clear the login error from localStorage
    localStorage.removeItem("loginError");
  }
});


// Function to check if the user is authenticated
function checkUserAuthentication() {
    // Check if the user is logged in by checking if the username is present in localStorage
    var username = localStorage.getItem('username');
    if (!username) {
        // If the username is not found, redirect the user to the login page
        alert('User not logged in. Redirecting to home page.');
        window.location.href = '../auth/login.php'; // Adjust the URL if needed
    }
}





