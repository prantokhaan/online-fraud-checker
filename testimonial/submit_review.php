<?php
include '../database/db.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $reviewText = $_POST['reviewText'];

    // Search for the full name using the username
    $stmt = $conn->prepare("SELECT fullName FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $fullName = $user['fullName'];

        // Insert the review into the review table
        $stmt = $conn->prepare("INSERT INTO review (reviewerName, review) VALUES (?, ?)");
        $stmt->bind_param("ss", $fullName, $reviewText);
        if ($stmt->execute()) {
            http_response_code(200);
        } else {
            http_response_code(500);
        }
        $stmt->close();
    } else {
        http_response_code(404); // User not found
    }
    $conn->close();
} else {
    http_response_code(405); // Method not allowed
}
?>
