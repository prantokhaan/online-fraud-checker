<?php
include '../database/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $courierName = $_POST['courier-name'];
    $customerName = $_POST['customer-name'];
    $phoneNumber = $_POST['phone-number'];
    $sellerName = $_POST['seller-name'];
    $sellerPhone = $_POST['seller-phone'];
    $courierBookingId = $_POST['courier-booking-id'];
    $orderedProduct = $_POST['ordered-product'];

    // Insert data into the database
    $sql = "INSERT INTO courier (courierName, customerName, customerPhone, sellerName, sellerPhone, courierBookingId, orderedProduct)
            VALUES ('$courierName', '$customerName', '$phoneNumber', '$sellerName', '$sellerPhone', '$courierBookingId', '$orderedProduct')";
    
    // Debugging: Check SQL query
    echo "SQL query: $sql<br>";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        header("Location: show_bookings.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();
}
?>
