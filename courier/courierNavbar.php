<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar with Conditional Content</title>
    <link rel="stylesheet" href="path/to/your/css/file.css">
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            function checkCourier() {
                var courier = localStorage.getItem("courier");
                console.log("Courier value:", courier); // Debugging line

                if (!courier) {
                    document.getElementById("login-link").style.display = "inline-block";
                    document.getElementById("navbar-image").style.display = "none";
                    document.getElementById("logout-link").style.display = "none";
                } else {
                    document.getElementById("login-link").style.display = "none";
                    document.getElementById("navbar-image").style.display = "inline-block";
                    document.getElementById("logout-link").style.display = "inline-block";
                    // Set the image source dynamically
                    document.getElementById("navbar-image").src = "./images/" + courier + ".png";
                }
            }

            checkCourier();
        });
    </script>
</head>
<body>
    <nav class="navbar">
        <ul>
            <li><a href="courier.php">Add Booking</a></li>
            <li><a href="show_bookings.php">View Bookings</a></li>
            <li>
                <a href="#" id="logout-link" onclick="logout()">Logout</a>
            </li>
            <li>
                <a href="courierLogin.php" id="login-link" style="display: none;">Login</a>
            </li>
        </ul>
        <img src="" alt="Small Image" class="navbar-image" id="navbar-image" style="display: none;">
    </nav>
</body>
</html>
