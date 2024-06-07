// Sample userAuthentication function
function checkLoginStatusForNavBAr() {
  // Assume you have some logic to determine if the user is logged in
  var isLoggedIn = true;

  var username = localStorage.getItem("username");
  console.log(username);
  if (!username) {
    isLoggedIn = false;
  }

  if (isLoggedIn) {
    // Fetch the username from wherever you're storing it

    // Show profile and logout links, hide login and register links
    document.getElementById("profile-link").style.display = "inline-block";
    document.getElementById("logout-link").style.display = "inline-block";
    document.getElementById("login-link").style.display = "none";
    document.getElementById("register-link").style.display = "none";

    // Set the username
    document.querySelector(".auth-buttons #profile-link span").textContent =
      username;
  } else {
    // Show login and register links, hide profile and logout links
    document.getElementById("profile-link").style.display = "none";
    document.getElementById("logout-link").style.display = "none";
    document.getElementById("login-link").style.display = "inline-block";
    document.getElementById("register-link").style.display = "inline-block";
  }
}

// Call the function when the page loads
window.onload = function () {
  checkLoginStatusForNavBAr();
};

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
