<?php
session_start();
include '../database/db.php';

// Check if the user ID is provided in the URL
if (isset($_GET['id'])) {
    // Sanitize the user ID to prevent SQL injection
    $userId = mysqli_real_escape_string($conn, $_GET['id']);

    // Fetch user information from the deletedUser table
    $query = "SELECT * FROM deletedUser WHERE id = '$userId'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Fetch user data
        $userData = $result->fetch_assoc();
    } else {
        // Redirect to a page indicating user not found
        header("Location: user_not_found.php");
        exit();
    }
} else {
    // Redirect to a page indicating invalid request
    header("Location: invalid_request.php");
    exit();
}

// Handle button clicks
if (isset($_POST['restore_account'])) {
    // Insert user data back into the users table
    $insertQuery = "INSERT INTO users (registerAs, fullName, shopName, subscriberStatus, age, phoneNumber, address, username, password, email, rejectedCount, accountStatus, banCount, created_at)
                    VALUES ('".$userData['registerAs']."', '".$userData['fullName']."', '".$userData['shopName']."', '".$userData['subscriberStatus']."', '".$userData['age']."', '".$userData['phoneNumber']."', '".$userData['address']."', '".$userData['username']."', '".$userData['password']."', '".$userData['email']."', '".$userData['rejectedCount']."', '".$userData['accountStatus']."', '".$userData['banCount']."', '".$userData['created_at']."')";
    
    if ($conn->query($insertQuery) === TRUE) {
        // Delete the user from the deletedUser table
        $deleteQuery = "DELETE FROM deletedUser WHERE id = '$userId'";
        if ($conn->query($deleteQuery) === TRUE) {
            // Redirect to view user page with success message
            echo "<script>
                alert('User restored successfully.');
                window.location.href = 'deleted_user_list.php';
            </script>";
            exit();
        } else {
            // Redirect to view user page with error message
            header("Location: view_deleted_user.php?id=$userId&status=error");
            exit();
        }
    } else {
        // Redirect to view user page with error message
        header("Location: view_deleted_user.php?id=$userId&status=error");
        exit();
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Deleted User</title>
    <!-- Import bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/view_user.css">
    <link rel="stylesheet" href="./css/admin_sidebar.css">
    <link rel="icon" href="../images/favicon.png">
</head>
<body>
    <!-- Include the admin sidebar using PHP -->
    <?php include 'admin_sidebar.php'; ?>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            <h2>View Deleted User</h2>
            <div class="user-info">
                <!-- Display user information -->
                <div class="info-item">
                    <label>Name:</label>
                    <span><?php echo $userData['fullName']; ?></span>
                </div>
                <div class="info-item">
                    <label>Email:</label>
                    <span><?php echo $userData['email']; ?></span>
                </div>
                <div class="info-item">
                    <label>Phone:</label>
                    <span><?php echo $userData['phoneNumber']; ?></span>
                </div>
                <div class="info-item">
                    <label>Age:</label>
                    <span><?php echo $userData['age']; ?></span>
                </div>
                <div class="info-item">
                    <label>Address:</label>
                    <span><?php echo $userData['address']; ?></span>
                </div>
                <div class="info-item">
                    <label>Username:</label>
                    <span><?php echo $userData['username']; ?></span>
                </div>
                <div class="info-item">
                    <label>Subscriber:</label>
                    <span><?php echo $userData['subscriberStatus']; ?></span>
                </div>
                <div class="info-item">
                    <label>Account Status:</label>
                    <span><?php echo $userData['accountStatus']; ?></span>
                </div>
                <div class="info-item">
                    <label>Rejection Count:</label>
                    <span><?php echo $userData['rejectedCount']; ?></span>
                </div>
                <div class="info-item">
                    <label>Ban Count:</label>
                    <span><?php echo $userData['banCount']; ?></span>
                </div>
                <!-- Add restore account button -->
                <form method="POST">
                    <div class="action-buttons">
                        <button type="submit" name="restore_account" class="btn btn-primary">Restore Account</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
