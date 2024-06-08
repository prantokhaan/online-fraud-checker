<?php
include '../database/db.php'; // Include your database connection file

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM customerComplain WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo "<script>
            alert('Complaint deleted successfully.');
            window.location.href = 'all_complaints.php';
        </script>";
    } else {
        echo "<script>
            alert('There was an error deleting the complaint. Please try again.');
            window.location.href = 'all_complaints.php';
        </script>";
    }
    $stmt->close();
    $conn->close();
} else {
    echo "<script>
        alert('Invalid request.');
        window.location.href = 'all_complaints.php';
    </script>";
}
?>
