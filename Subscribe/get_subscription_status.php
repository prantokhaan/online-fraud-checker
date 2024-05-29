<?php
include '../database/db.php'; // Assuming this file sets up the database connection

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $username = $_GET['username'];

    if (empty($username)) {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid request.']);
        exit;
    }

    $stmt = $conn->prepare("SELECT subscriberStatus FROM users WHERE username = ?");
    if ($stmt === false) {
        http_response_code(500);
        echo json_encode(['error' => 'Prepare failed: ' . $conn->error]);
        exit;
    }

    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->bind_result($subscriberStatus);
    $stmt->fetch();

    if ($subscriberStatus !== null) {
        echo json_encode(['subscriberStatus' => $subscriberStatus]);
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'User not found.']);
    }

    $stmt->close();
}
?>
