<?php
// Include the database connection file
include 'db.php';

// Check if username is provided in the URL parameters
if(isset($_GET['username'])) {
    // Sanitize the username input to prevent SQL injection
    $username = mysqli_real_escape_string($conn, $_GET['username']);

    // Prepare and execute the SQL statement to retrieve user information
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if($result->num_rows == 1) {
        // Fetch user information
        $user_info = $result->fetch_assoc();

        // Close statement and connection
        $stmt->close();
        $conn->close();

        // Convert the user information to JSON format and output
        header('Content-Type: application/json');
        echo json_encode($user_info);
    } else {
        // User not found
        echo json_encode(array('error' => 'User not found'));
    }
} else {
    // Username parameter not provided
    echo json_encode(array('error' => 'Username parameter not provided'));
}
?>
