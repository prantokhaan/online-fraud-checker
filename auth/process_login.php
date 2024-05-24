<?php
session_start();
include '../database/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute the SQL statement to retrieve user information
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($userId, $dbUsername, $dbPassword);
        $stmt->fetch();

        // Verify password
        if (password_verify($password, $dbPassword)) {
            // Password is correct, set session variables
            $_SESSION['user_id'] = $userId; // Set user ID to session
            $_SESSION['username'] = $dbUsername;

            // Redirect to index.php
            header("Location: ../index.php");
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
echo "<script>window.onload = function() { localStorage.setItem('loginError', '" . $error . "'); }</script>";
?>
