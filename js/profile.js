// Function to check if username exists in localStorage
function checkUserLogin() {
  var username = localStorage.getItem("username");
  if (!username) {
    window.location.href = "../index.php";
  }
  return username;
}

// Function to fetch user information from the database based on username
function fetchUserInfo() {
  var username = checkUserLogin();

  if (username) {
    // Fetch user information from the server using AJAX
    var xhr = new XMLHttpRequest();
    xhr.open(
      "GET",
      "../database/fetch_user_info.php?username=" + username,
      true
    );
    xhr.onload = function () {
      if (xhr.status === 200) {
        // Parse the JSON response
        var userInfo = JSON.parse(xhr.responseText);
        // Update the user information in the HTML
        document.getElementById("user-info").innerHTML = `
          <div class="form-group">
              <label>Full Name:</label>
              <span>${userInfo.fullName}</span>
          </div>
          <div class="form-group">
              <label>Age:</label>
              <span>${userInfo.age}</span>
          </div>
          <div class="form-group">
              <label>Email:</label>
              <span>${userInfo.email}</span>
          </div>
          <div class="form-group">
              <label>Address:</label>
              <span>${userInfo.address}</span>
          </div>
          <div class="form-group">
              <label>Phone Number:</label>
              <span>${userInfo.phoneNumber}</span>
          </div>
          <div class="form-group">
              <label>Account Type:</label>
              <span>${userInfo.registerAs}</span>
          </div>
          <div class="form-group">
              <label>Shop Name:</label>
              <span>${userInfo.shopName ? userInfo.shopName : "N/A"}</span>
          </div>
          <div class="form-group">
              <label>Subscribe Status:</label>
              <span id="subscriber-status">${userInfo.subscriberStatus}</span>
              
          </div>
          <div class="form-group">
              <label>Account Status:</label>
              <span id="account-status">${userInfo.accountStatus}</span>
              ${
                userInfo.accountStatus.toLowerCase() === "banned"
                  ? `<button onclick="alert('Request Sent')" class="request-button">Request To Activate Account</button>`
                  : ""
              }
          </div>
          <div class="form-group">
              <label>Rejected Count:</label>
              <span id="rejected-count">${userInfo.rejectedCount}</span>
              <span>(If you hit 5 Rejection, You will be automatically banned)</span>
          </div>
          <div class="form-group">
              <label>Account Created At:</label>
              <span>${userInfo.created_at}</span>
          </div>
        `;

        // Apply background color based on subscriber status
        var subscriberStatusElement =
          document.getElementById("subscriber-status");
        applyBackgroundColor(
          subscriberStatusElement,
          userInfo.subscriberStatus
        );

        // Apply background color based on account status
        var accountStatusElement = document.getElementById("account-status");
        applyAccountStatusColor(accountStatusElement, userInfo.accountStatus);
      } else {
        console.error("Error fetching user information. Status: " + xhr.status);
      }
    };
    xhr.send();
  }
}

// Apply background color based on status
function applyBackgroundColor(element, status) {
  var lowerCaseStatus = status.toLowerCase();
  switch (lowerCaseStatus) {
    case "none":
      element.style.backgroundColor = "red";
      element.style.color = "white";
      break;
    case "premium":
      element.style.backgroundColor = "green";
      element.style.color = "white";
      break;
    case "standard":
      element.style.backgroundColor = "blue";
      element.style.color = "white";
      break;
    default:
      element.style.backgroundColor = "orange";
      element.style.color = "white";
      break;
  }
}

function applyAccountStatusColor(element, status){
  var lowerCaseStatus = status.toLowerCase();
  switch (lowerCaseStatus) {
    case "banned":
      element.style.backgroundColor = "red";
      element.style.color = "white";
      break;
    default:
      element.style.backgroundColor = "green";
      element.style.color = "white";
      break;
  }

}

// Call the fetchUserInfo function when the page loads
window.onload = fetchUserInfo;
