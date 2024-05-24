<?php
session_start();
include '../database/db.php';

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userName = $_POST['username']; // Get username from the form
    $customerName = $_POST['customerName'];
    $customerEmail = $_POST['customerEmail'];
    $customerPhone = $_POST['customerPhone'];
    $customerAddress = $_POST['customerAddress'];
    $customerFBLink = $_POST['customerFacebookId'];
    $courierName = $_POST['courierName'];
    $courierBookingId = $_POST['courierDeliveryId'];
    $orderedProduct = $_POST['orderedProduct'];
    $imageLink = $_POST['proofImageLink'];

    // Check if customer exists in fakeCustomers table
    $stmt = $conn->prepare("SELECT id FROM fakeCustomers WHERE customerName = ? OR customerEmail = ? OR customerPhone = ? OR customerAddress = ? OR customerFBLink = ?");
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt->bind_param("sssss", $customerName, $customerEmail, $customerPhone, $customerAddress, $customerFBLink);
    $stmt->execute();
    $result = $stmt->get_result();
    $customer = $result->fetch_assoc();

    if ($customer) {
        // Customer found, call stored procedure to increment complainCount
        $customerId = $customer['id'];
        $stmt = $conn->prepare("CALL IncrementComplainCount(?)");
        if (!$stmt) {
            die("Error preparing statement: " . $conn->error);
        }
        $stmt->bind_param("i", $customerId);
        $stmt->execute();
    } else {
        // Customer not found, insert as fake customer
        $stmt = $conn->prepare("INSERT INTO fakeCustomers (customerName, customerEmail, customerPhone, customerAddress, customerFBLink, complainCount) VALUES (?, ?, ?, ?, ?, 1)");
        if (!$stmt) {
            die("Error preparing statement: " . $conn->error);
        }
        $stmt->bind_param("sssss", $customerName, $customerEmail, $customerPhone, $customerAddress, $customerFBLink);
        $stmt->execute();
    }

    // Insert complaint
    $stmt = $conn->prepare("INSERT INTO customerComplain (userName, customerName, customerEmail, customerPhone, customerAddress, customerFBLink, courierName, courierBookingId, orderedProduct, imageLink, complainStatus) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Pending')");
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt->bind_param("ssisssssss", $userName, $customerName, $customerEmail, $customerPhone, $customerAddress, $customerFBLink, $courierName, $courierBookingId, $orderedProduct, $imageLink);
    if ($stmt->execute()) {
        echo "Complaint submitted successfully!";
        header("Location: profile.php");
        exit();
    } else {
        echo "Error executing statement: " . $stmt->error;
        // Log error to file
        error_log("Error executing statement: " . $stmt->error, 0);
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
