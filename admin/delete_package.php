<?php
include '../database/db.php';

// Check if the ID is provided
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the package from the database
    $query = "DELETE FROM pricing WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $message = "Package deleted successfully!";
    } else {
        $message = "Error: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    $message = "No package ID provided!";
}

// Redirect back to the view packages page with a message
header("Location: view_packages.php?message=" . urlencode($message));
exit();
?>
