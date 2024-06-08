<?php
include '../database/db.php'; // Include your database connection file

if (isset($_GET['id']) && isset($_GET['name'])) {
    $id = $_GET['id'];
    $courierName = $_GET['name'];
    $file = '../courier/images/' . $courierName . '.png';

    // Delete record from the database
    $stmt = $conn->prepare("DELETE FROM courierAccount WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        // Delete image file
        if (file_exists($file)) {
            unlink($file);
        }
        echo "<script>
            alert('Courier account deleted successfully.');
            window.location.href = 'all_courier_list.php';
        </script>";
    } else {
        echo "<script>
            alert('There was an error deleting the courier account. Please try again.');
            window.location.href = 'all_courier_list.php';
        </script>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<script>
        alert('Invalid request.');
        window.location.href = 'all_courier_list.php';
    </script>";
}
?>
