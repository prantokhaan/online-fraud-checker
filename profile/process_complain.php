<?php
session_start();
include '../database/db.php';

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userName = $_POST['username']; // Get username from the form
    $sellerName = $_POST['sellerName'];
    $sellerEmail = $_POST['sellerEmail'];
    $sellerPhone = $_POST['sellerPhone'];
    $sellerAddress = $_POST['sellerAddress'];
    $sellerFBLink = $_POST['sellerFBLink'];
    $courierName = $_POST['courierName'];
    $courierBookingId = $_POST['courierBookingId'];
    $orderedProduct = $_POST['orderedProduct'];
    $imageLink = $_POST['imageLink'];

    // Check if seller exists in fakeSellers table
    $stmt = $conn->prepare("SELECT id FROM fakeSellers WHERE sellerName = ? OR sellerEmail = ? OR sellerPhone = ? OR sellerAddress = ? OR sellerFBLink = ?");
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt->bind_param("sssss", $sellerName, $sellerEmail, $sellerPhone, $sellerAddress, $sellerFBLink);
    $stmt->execute();
    $result = $stmt->get_result();
    $seller = $result->fetch_assoc();

    if ($seller) {
        // Seller found, call stored procedure to increment complainCount
        $sellerId = $seller['id'];
        $stmt = $conn->prepare("CALL IncrementSellerComplainCount(?)");
        if (!$stmt) {
            die("Error preparing statement: " . $conn->error);
        }
        $stmt->bind_param("i", $sellerId);
        $stmt->execute();
    } else {
        // Seller not found, insert as fake seller
        $stmt = $conn->prepare("INSERT INTO fakeSellers (sellerName, sellerEmail, sellerPhone, sellerAddress, sellerFBLink, complainCount) VALUES (?, ?, ?, ?, ?, 1)");
        if (!$stmt) {
            die("Error preparing statement: " . $conn->error);
        }
        $stmt->bind_param("sssss", $sellerName, $sellerEmail, $sellerPhone, $sellerAddress, $sellerFBLink);
        $stmt->execute();
    }

    // Insert complaint
    $stmt = $conn->prepare("INSERT INTO sellerComplain (userName, sellerName, sellerEmail, sellerPhone, sellerAddress, sellerFBLink, courierName, courierBookingId, orderedProduct, imageLink, complainStatus) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Pending')");
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt->bind_param("ssisssssss", $userName, $sellerName, $sellerEmail, $sellerPhone, $sellerAddress, $sellerFBLink, $courierName, $courierBookingId, $orderedProduct, $imageLink);
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
