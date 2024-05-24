document.addEventListener("DOMContentLoaded", function () {
  fetchUserInfoAndUpdateSidebar();
});

function fetchUserInfoAndUpdateSidebar() {
  var username = localStorage.getItem("username");

  if (username) {
    var xhr = new XMLHttpRequest();
    xhr.open(
      "GET",
      "../database/fetch_user_info.php?username=" + username,
      true
    );
    xhr.onload = function () {
      if (xhr.status === 200) {
        var userInfo = JSON.parse(xhr.responseText);
        updateSidebar(userInfo);
      } else {
        console.error("Error fetching user information. Status: " + xhr.status);
      }
    };
    xhr.send();
  } else {
    window.location.href = "../auth/login.php";
  }
}

function updateSidebar(userInfo) {
  var sidebarMenu = document.querySelector(".menu");
  if (userInfo.registerAs === "seller") {
    // Remove "Complain a Seller" if the user is a seller
    removeMenuItem(sidebarMenu, "Complain a Seller");
    removeMenuItem(sidebarMenu, "Fake Shop List");
    removeMenuItem(sidebarMenu, "Trusted Shop List");
    removeMenuItem(sidebarMenu, "My Complain History");
    removeMenuItem(sidebarMenu, "Search");
  } else if (userInfo.registerAs === "customer") {
    // Remove "Complain a Customer" if the user is a customer
    removeMenuItem(sidebarMenu, "Complain a Customer");
    removeMenuItem(sidebarMenu, "Fake Customer List");
    removeMenuItem(sidebarMenu, "Complain History");
    removeMenuItem(sidebarMenu, "Search Customer");
  }

  // Add logout functionality
  var logoutLink = sidebarMenu.querySelector('a[href="#"]');
  if (logoutLink) {
    logoutLink.addEventListener("click", function (event) {
      event.preventDefault();
      logout();
    });
  }
}

function removeMenuItem(menu, itemText) {
  var items = menu.querySelectorAll("li");
  items.forEach(function (item) {
    var link = item.querySelector("a");
    if (link && link.textContent.trim() === itemText) {
      menu.removeChild(item);
    }
  });
}

function logout() {
  localStorage.removeItem("username");
  localStorage.removeItem("userId");
  window.location.href = "../auth/login.php";
}
