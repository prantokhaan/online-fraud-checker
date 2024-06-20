<?php
include '../database/db.php'; 

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM sellerComplain WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo "<script>
            alert('Complaint deleted successfully.');
            window.location.href = 'all_seller_complaints.php';
        </script>";
    } else {
        echo "<script>
            alert('There was an error deleting the complaint. Please try again.');
            window.location.href = 'all_seller_complaints.php';
        </script>";
    }
    $stmt->close();
    $conn->close();
} else {
    echo "<script>
        alert('Invalid request.');
        window.location.href = 'all_seller_complaints.php';
    </script>";
}
?>
