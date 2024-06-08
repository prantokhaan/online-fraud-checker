<?php
include '../database/db.php'; // Include your database connection file

if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = $_GET['id'];
    $status = $_GET['status'] == 'accepted' ? 'accepted' : 'rejected';

    $stmt = $conn->prepare("UPDATE customerComplain SET complainStatus = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $id);

    if ($stmt->execute()) {
        echo "<script>
            alert('Complaint status updated successfully.');
            window.location.href = 'view_complaint.php?id=$id';
        </script>";
    } else {
        echo "<script>
            alert('There was an error updating the complaint status. Please try again.');
            window.location.href = 'view_complaint.php?id=$id';
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
