<?php
session_start();
include '../database/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute the SQL statement to retrieve user information
    $stmt = $conn->prepare("SELECT id, courierName, courierPassword FROM courierAccount WHERE courierName = ?");
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($userId, $dbUsername, $dbPassword);
        $stmt->fetch();

        // Verify password (no hashing)
        if ($password === $dbPassword) {
            // Output JavaScript to set username in localStorage
            echo "<script>
                localStorage.setItem('courier', '" . addslashes($dbUsername) . "');
                window.location.href = './show_bookings.php';
            </script>";
            exit();
        } else {
            // Password is incorrect
            $error = "Incorrect password";
        }
    } else {
        // No user found with the provided username
        $error = "Username not found";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}

// If we reach here, it means there was an error
echo "<script>
    window.onload = function() { 
        alert('" . addslashes($error) . "'); 
        window.location.href = './courierLogin.php';
    }
</script>";
?>
