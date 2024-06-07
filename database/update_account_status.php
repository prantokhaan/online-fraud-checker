<?php
session_start();
include 'db.php';

// Check if the username and status parameters are provided
if (isset($_POST['username']) && isset($_POST['status'])) {
    // Sanitize the input data to prevent SQL injection
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    // Update the user's account status in the database
    $updateQuery = "UPDATE users SET accountStatus = '$status' WHERE username = '$username'";
    if ($conn->query($updateQuery) === TRUE) {
        // Return success message if the update is successful
        echo "success";
    } else {
        // Return error message if the update fails
        echo "error";
    }
} else {
    // Return error message if the parameters are not provided
    echo "error";
}

// Close the database connection
$conn->close();
?>
