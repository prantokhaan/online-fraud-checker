// fetchComplainHistory.js

document.addEventListener("DOMContentLoaded", function () {
  // Check if the user is logged in and get the username from localStorage
  var username = localStorage.getItem("username");
  if (username) {
    // Fetch complain history data using AJAX
    var xhr = new XMLHttpRequest();
    xhr.open(
      "GET",
      "../profile/fetch_complain_history.php?username=" + username,
      true
    );
    xhr.onload = function () {
      if (xhr.status === 200) {
        var data = JSON.parse(xhr.responseText);
        displayComplainHistory(data);
      } else {
        console.error("Error fetching complain history. Status: " + xhr.status);
      }
    };
    xhr.send();
  } else {
    console.error("Username not found in localStorage.");
  }
});

function displayComplainHistory(data) {
  var tbody = document.querySelector("tbody");
  tbody.innerHTML = "";

  data.forEach(function (row) {
    var tr = document.createElement("tr");

    // Set background color based on status
    var statusClass = getStatusBadgeClass(row.complainStatus);
    tr.innerHTML = `
        <td>${row.id}</td>
        <td>${row.customerName}</td>
        <td>${row.courierName}</td>
        <td>${row.courierBookingId}</td>
        <td>${row.created_at}</td>
        <td><span class="badge badge-${statusClass}">${row.complainStatus}</span></td>
        <td>
            <a href="edit_complain.php?id=${row.id}" class="action-icon"><i class="fas fa-edit"></i></a>
            <button class="action-icon delete-complain-btn" data-id="${row.id}"><i class="fas fa-trash-alt"></i></button>
        </td>
    `;
    tbody.appendChild(tr);
  });

  // Add event listeners to delete buttons
  var deleteButtons = document.querySelectorAll(".delete-complain-btn");
  deleteButtons.forEach(function (button) {
    button.addEventListener("click", function () {
      var complainId = this.dataset.id;
      deleteComplain(complainId);
    });
  });
}

function getStatusBadgeClass(status) {
  switch (status) {
    case "Pending":
      return "warning"; // Yellow
    case "Resolved":
      return "success"; // Green
    case "Rejected":
      return "danger"; // Red
    default:
      return "primary"; // Default color
  }
}

function deleteComplain(complainId) {
  $("#confirmDeleteModal").modal("show");

  // When the user confirms deletion
  $("#confirmDeleteBtn").click(function () {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../profile/delete_complain.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function () {
      if (xhr.status === 200) {
        // Reload the complain history after deletion
        location.reload();
      } else {
        console.error("Error deleting complain. Status: " + xhr.status);
      }
    };
    xhr.send("id=" + complainId);
  });
}

