// Function to check if the user is authenticated
function checkUserAuthentication() {
    var currentPage = window.location;
    console.log(currentPage);
  // Check if the user is logged in by checking if the username is present in localStorage
  var username = localStorage.getItem("username");
  if (!username) {
    // If the username is not found, redirect the user to the login page
    alert("User not logged in. Redirecting to login page.");
    window.location.href = "../auth/login.php"; // Adjust the URL if needed
  }
}


window.onload = checkUserAuthentication();

const logOutButton = document.getElementById("logout-link");
logOutButton.addEventListener("click", function () {
  logout();
});
function logout() {
  // Remove username from localStorage
  localStorage.removeItem("username");
  // Redirect to the login page
  window.location.href = "../auth/login.php";
}