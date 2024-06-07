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

    // Step 1: Search with the courierBookingId in the courier table
    $stmt = $conn->prepare("SELECT * FROM courier WHERE courierBookingId = ?");
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt->bind_param("s", $courierBookingId);
    $stmt->execute();
    $result = $stmt->get_result();
    $courier = $result->fetch_assoc();

    // Step 2: Search with the username in the users table
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt->bind_param("s", $userName);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();


    // Step 3: Match courier table data with user table data
    if ($courier && $user &&
    strtolower($courier['customerName']) === strtolower($user['fullName']) &&
    strtolower($courier['customerPhone']) === strtolower($user['phoneNumber']) &&
    strtolower($courier['sellerName']) === strtolower($sellerName) &&
    strtolower($courier['sellerPhone']) === strtolower($sellerPhone) &&
    strtolower($courier['courierName']) === strtolower($courierName) &&
    strtolower($courier['orderedProduct']) === strtolower($orderedProduct)) {
    $complainStatus = 'Accepted';
    echo "Complaint status: Accepted";

    $stmt = $conn->prepare("UPDATE fakeSellers SET complainCount = complainCount + 1 WHERE sellerName = ?");
        if (!$stmt) {
            die("Error preparing statement: " . $conn->error);
        }
        $stmt->bind_param("s", $sellerName);
        $stmt->execute();
} else {
    $complainStatus = 'Rejected';
    echo "Complaint status: Rejected";
    echo "Details did not match";

    // Step 5: If rejected, update user details
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt->bind_param("s", $userName);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        $rejectedCount = $user['rejectedCount'] + 1;
        $accountStatus = $user['accountStatus'];

        // Increment rejectedCount and update accountStatus if needed
        if ($rejectedCount >= 5) {
            $rejectedCount = 0; // Reset rejectedCount
            $accountStatus = 'banned';
            echo "<script>
            alert('You are banned from the system due to multiple rejections.');
            window.location.href = 'profile.php';
            </script>";
        }

        // Update user record
        $stmt = $conn->prepare("UPDATE users SET rejectedCount = ?, accountStatus = ? WHERE username = ?");
        if (!$stmt) {
            die("Error preparing statement: " . $conn->error);
        }
        $stmt->bind_param("iss", $rejectedCount, $accountStatus, $userName);
        $stmt->execute();

        
    } else {
        echo "User not found.";
    }
}

    // Step 4: Insert complaint
    $stmt = $conn->prepare("INSERT INTO sellerComplain (userName, sellerName, sellerEmail, sellerPhone, sellerAddress, sellerFBLink, courierName, courierBookingId, orderedProduct, imageLink, complainStatus) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt->bind_param("ssissssssss", $userName, $sellerName, $sellerEmail, $sellerPhone, $sellerAddress, $sellerFBLink, $courierName, $courierBookingId, $orderedProduct, $imageLink, $complainStatus);
    if ($stmt->execute()) {
        echo "<script>
            alert('Complaint submitted successfully');
            window.location.href = 'profile.php';
        </script>";
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
