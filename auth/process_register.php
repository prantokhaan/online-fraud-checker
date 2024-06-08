<?php
// process_register.php
include '../database/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $registerAs = $_POST['registerAs'];
    $fullName = $_POST['fullName'];
    $shopName = !empty($_POST['shopName']) ? $_POST['shopName'] : null; // Check if shopName is provided
    $age = $_POST['age'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $phoneNumber = $_POST['phoneNumber'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Check if passwords match
    if ($password !== $confirmPassword) {
        die("Passwords do not match.");
    }

    if($registerAs == 'seller' && empty($shopName)) {
        header("Location: register.php?error=shop_name_required");
        exit();
    }

    // Check if username already exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Username exists
        $stmt->close();
        $conn->close();
        header("Location: register.php?error=username_exists");
        exit();
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare the SQL statement to insert the new user
    $stmt = $conn->prepare("INSERT INTO users (registerAs, fullName, shopName, age, phoneNumber, address, username, password, email, subscriberStatus, accountStatus, rejectedCount) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'None', 'Active', 0)");
    $stmt->bind_param("sssisssss", $registerAs, $fullName, $shopName, $age, $phoneNumber, $address, $username, $hashedPassword, $email);

    // Execute the statement
    if ($stmt->execute()) {
        echo "New record created successfully";
        header("Location: login.php");
    } else {
        echo "Error: " . $stmt->error;
        // Log the error to the console
        echo "<script>console.error('Error: " . $stmt->error . "');</script>";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
