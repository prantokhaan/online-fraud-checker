<?php
session_start();
include '../database/db.php';

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the complaint ID is provided in the POST data
    if (isset($_POST['id'])) {
        $complainId = $_POST['id'];

        // Prepare a SQL statement to delete the complaint with the provided ID
        $stmt = $conn->prepare("DELETE FROM sellerComplain WHERE id = ?");
        $stmt->bind_param("i", $complainId);

        // Execute the statement
        if ($stmt->execute()) {
            // Return a success message if deletion is successful
            echo "Complaint deleted successfully!";
        } else {
            // Return an error message if deletion fails
            echo "Error deleting complaint: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        // Return an error message if complaint ID is not provided
        echo "Complaint ID not provided!";
    }
} else {
    // Return an error message if the request method is not POST
    echo "Invalid request method!";
}
?>
