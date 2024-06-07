

function subscribe(plan) {
  const username = localStorage.getItem("username");
  console.log("Button clicked for ", username, " and ", plan);
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "update_subscription.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    if (xhr.status === 200) {
      alert("Subscription updated successfully!");
      window.location.href = "../profile/profile.php";
    } else {
      alert("Error updating subscription. Please try again.");
    }
  };
  xhr.send(
    "username=" +
      encodeURIComponent(username) +
      "&plan=" +
      encodeURIComponent(plan)
  );
}
