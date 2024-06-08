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
    $customerFBLink = $_POST['customerFBLink'];
    $courierName = $_POST['courierName'];
    $courierBookingId = $_POST['courierBookingId'];
    $orderedProduct = $_POST['orderedProduct'];
    $imageLink = $_POST['imageLink'];
    $complainStatus = '';

    // Step 1: Check if there is already an accepted complaint with the same userName, customerName, customerPhone, and courierBookingId
    $stmt = $conn->prepare("SELECT * FROM customerComplain WHERE userName = ? AND customerName = ? AND customerPhone = ? AND courierBookingId = ? AND complainStatus = 'Accepted'");
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt->bind_param("ssss", $userName, $customerName, $customerPhone, $courierBookingId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        header("Location: customer_complain.php?error=accepted_complaint_exists");
        // echo "<script>
        //     alert('You have already filed an accepted complaint with these details.');
        //     window.location.href = 'profile.php';
        // </script>";
        exit();
    }

    // Step 2: Search with the courierBookingId in the courier table
    $stmt = $conn->prepare("SELECT * FROM courier WHERE courierBookingId = ?");
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt->bind_param("s", $courierBookingId);
    $stmt->execute();
    $result = $stmt->get_result();
    $courier = $result->fetch_assoc();

    // Step 3: Search with the username in the users table
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt->bind_param("s", $userName);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Step 4: Match courier table data with user table data
    if ($courier && $user &&
        strtolower($courier['sellerName']) === strtolower($user['shopName']) &&
        strtolower($courier['sellerPhone']) === strtolower($user['phoneNumber']) &&
        strtolower($courier['customerName']) === strtolower($customerName) &&
        strtolower($courier['customerPhone']) === strtolower($customerPhone) &&
        strtolower($courier['courierName']) === strtolower($courierName) &&
        strtolower($courier['orderedProduct']) === strtolower($orderedProduct)) {
        
        $complainStatus = 'Accepted';
        echo "Complaint status: Accepted";

        // Check if customer exists in fakeCustomers table
        $stmt = $conn->prepare("SELECT id FROM fakeCustomers WHERE customerName = ? OR customerEmail = ? OR customerPhone = ? OR customerFBLink = ?");
        if (!$stmt) {
            die("Error preparing statement: " . $conn->error);
        }
        $stmt->bind_param("ssss", $customerName, $customerEmail, $customerPhone, $customerFBLink);
        $stmt->execute();
        $result = $stmt->get_result();
        $customer = $result->fetch_assoc();

        if ($customer) {
            // Customer found, call stored procedure to increment complainCount
            $customerId = $customer['id'];
            
            $stmt = $conn->prepare("CALL incrementComplainCount(?)");
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
            $banCount = $user['banCount'];

            // Increment rejectedCount and update accountStatus if needed
            if ($rejectedCount >= 5) {
                $rejectedCount = 0; // Reset rejectedCount
                $accountStatus = 'banned';
                $banCount += 1;
                if ($banCount >= 2) {
                    $sql = "DELETE FROM users WHERE username = '$userName'";
                    if ($conn->query($sql) === TRUE) {
                        echo "<script>
                            alert('Your account has been deleted due to multiple bans.');
                            localStorage.clear();
                            window.location.href = '../index.php';
                        </script>";
                    } else {
                        echo "Error deleting record: " . $conn->error;
                    }
                } else {
                    echo "<script>
                        alert('You are banned from the system due to multiple rejections.');
                        window.location.href = 'profile.php';
                    </script>";
                }
            }

            // Update user record
            $stmt = $conn->prepare("UPDATE users SET rejectedCount = ?, accountStatus = ?, banCount = ? WHERE username = ?");
            if (!$stmt) {
                die("Error preparing statement: " . $conn->error);
            }
            $stmt->bind_param("isss", $rejectedCount, $accountStatus, $banCount, $userName);
            $stmt->execute();
        } else {
            echo "User not found.";
        }
    }

    // Step 6: Insert complaint
    $stmt = $conn->prepare("INSERT INTO customerComplain (userName, customerName, customerEmail, customerPhone, customerAddress, customerFBLink, courierName, courierBookingId, orderedProduct, imageLink, complainStatus) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt->bind_param("ssissssssss", $userName, $customerName, $customerEmail, $customerPhone, $customerAddress, $customerFBLink, $courierName, $courierBookingId, $orderedProduct, $imageLink, $complainStatus);
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
