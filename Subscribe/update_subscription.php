<?php
include '../database/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $plan = $_POST['plan'];

    if (empty($username) || empty($plan)) {
        http_response_code(400);
        echo "Invalid request.";
        exit;
    }

    $subscriberStatus = '';

    switch ($plan) {
        case 'Basic':
            $subscriberStatus = 'Basic';
            break;
        case 'Standard':
            $subscriberStatus = 'Standard';
            break;
        case 'Premium':
            $subscriberStatus = 'Premium';
            break;
        default:
            http_response_code(400);
            echo "Invalid plan selected.";
            exit;
    }

    // Prepare the SQL statement
    $stmt = $conn->prepare("UPDATE users SET subscriberStatus = ? WHERE username = ?");
    if ($stmt === false) {
        http_response_code(500);
        echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
        exit;
    }

    // Bind parameters
    $stmt->bind_param('ss', $subscriberStatus, $username);

    // Execute the statement
    if ($stmt->execute()) {
        http_response_code(200);
        echo "Subscription updated successfully.";
        header("Location: ../profile/profile.php");
    } else {
        http_response_code(500);
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}
?>
