<?php
session_start();
include '../database/db.php';

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmNewPassword = $_POST['confirmNewPassword'];

    // Validate inputs
    if ($newPassword !== $confirmNewPassword) {
        echo "New password and confirm password do not match.";
        exit();
    }

    // Check if email exists in the database
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (!$user) {
        echo "Email not found.";
        exit();
    }

    // Verify old password
    if (!password_verify($oldPassword, $user['password'])) {
        echo "Incorrect old password.";
        exit();
    }

    // Hash the new password
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    // Update the password in the database
    $stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt->bind_param("si", $hashedPassword, $user['id']);
    if ($stmt->execute()) {
        // Password changed successfully
        $_SESSION['password_change_success'] = true;
        header("Location: change_password.php");
        exit();
    } else {
        $_SESSION['password_change_error'] = "Error updating password: " . $stmt->error;
        header("Location: change_password.php");
        exit();
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
