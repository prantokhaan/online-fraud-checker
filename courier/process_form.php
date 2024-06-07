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

    // Check if the entry already exists
    $existing_sql = "SELECT * FROM courier WHERE courierBookingId = '$courierBookingId'";
    $existing_result = $conn->query($existing_sql);

    if ($existing_result->num_rows > 0) {
        echo "<script>alert('An entry with the provided booking ID already exists.')
        window.location.href = 'courier.php';
        </script>";
    } else {
        // Insert data into the database
        $sql = "INSERT INTO courier (courierName, customerName, customerPhone, sellerName, sellerPhone, courierBookingId, orderedProduct)
                VALUES ('$courierName', '$customerName', '$phoneNumber', '$sellerName', '$sellerPhone', '$courierBookingId', '$orderedProduct')";
        
        // Debugging: Check SQL query
        echo "SQL query: $sql<br>";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('New record created successfully')
            window.location.href = 'show_bookings.php';
            </script>";
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
}
?>
