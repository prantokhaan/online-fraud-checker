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
