<?php
session_start();
include '../database/db.php';

// Check if the user ID is provided in the URL
if (isset($_GET['id'])) {
    // Sanitize the user ID to prevent SQL injection
    $userId = mysqli_real_escape_string($conn, $_GET['id']);

    // Fetch user information from the users table
    $query = "SELECT * FROM users WHERE id = '$userId'";
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
if (isset($_POST['cancel_subscription'])) {
    // Update user's subscriberStatus to 'none'
    $updateQuery = "UPDATE users SET subscriberStatus = 'none' WHERE id = '$userId'";
    if ($conn->query($updateQuery) === TRUE) {
        // Redirect to view user page with success message
        echo "<script>
            alert('Subscription cancelled successfully.');
            window.location.href = 'view_user.php?id=$userId&status=subscription_cancelled';
        </script>";
        exit();
    } else {
        // Redirect to view user page with error message
        header("Location: view_user.php?id=$userId&status=error");
        exit();
    }
}

if (isset($_POST['ban_user'])) {
    // Increment the banCount by 1
    $updateQuery = "UPDATE users SET accountStatus = 'banned', banCount = banCount + 1 WHERE id = '$userId'";
    if ($conn->query($updateQuery) === TRUE) {
        // Check if banCount reaches 2
        $selectQuery = "SELECT banCount FROM users WHERE id = '$userId'";
        $result = $conn->query($selectQuery);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $banCount = $row['banCount'];
            if ($banCount >= 2) {
                // Delete the user
                $deleteQuery = "DELETE FROM users WHERE id = '$userId'";
                if ($conn->query($deleteQuery) === TRUE) {
                    // Redirect to view user page with success message
                    echo "<script>
                        alert('User deleted successfully due to multiple bans.');
                        window.location.href = 'view_user.php?status=user_deleted';
                    </script>";
                    exit();
                } else {
                    // Redirect to view user page with error message
                    header("Location: view_user.php?id=$userId&status=error");
                    exit();
                }
            } else {
                // Redirect to view user page with success message
                echo "<script>
                    alert('User banned successfully.');
                    window.location.href = 'view_user.php?id=$userId&status=user_banned';
                </script>";
                exit();
            }
        } else {
            // Redirect to view user page with error message
            header("Location: view_user.php?id=$userId&status=error");
            exit();
        }
    } else {
        // Redirect to view user page with error message
        header("Location: view_user.php?id=$userId&status=error");
        exit();
    }
}


if (isset($_POST['activate_user'])) {
    // Check if the user's account status is 'requested'
    if ($userData['accountStatus'] === 'requested') {
        // Update user's account status to 'active'
        $updateQuery = "UPDATE users SET accountStatus = 'active' WHERE id = '$userId'";
        if ($conn->query($updateQuery) === TRUE) {
            // Redirect to view user page with success message
            echo "<script>
                alert('User activated successfully.');
                window.location.href = 'view_user.php?id=$userId&status=user_activated';
            </script>";
            exit();
        } else {
            // Redirect to view user page with error message
            header("Location: view_user.php?id=$userId&status=error");
            exit();
        }
    } else {
        // Echo alert message if user's account status is not 'requested'
        echo "<script>
            alert('User has not requested activation yet.');
        </script>";
    }
}

if (isset($_POST['delete_user'])) {
    // Delete the user from the database
    $deleteQuery = "DELETE FROM users WHERE id = '$userId'";
    if ($conn->query($deleteQuery) === TRUE) {
        // Redirect to a page indicating user deletion success
        header("Location: user_deleted.php");
        exit();
    } else {
        // Redirect to view user page with error message
        header("Location: view_user.php?id=$userId&status=error");
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
    <title>View User</title>
    <!-- Import bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/view_user.css">
    <link rel="stylesheet" href="../css/admin_sidebar.css">
    <link rel="icon" href="../images/favicon.png">
</head>
<body>
    <!-- Include the admin sidebar using PHP -->
    <?php include 'admin_sidebar.php'; ?>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            <h2>View User</h2>
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
                <!-- Add action buttons -->
                <form method="POST">
                    <div class="action-buttons">
                        <button type="submit" name="cancel_subscription" class="btn-cancel-subscription">Cancel Subscription</button>
                        <button type="submit" name="ban_user" class="btn-ban-user">Ban User</button>
                        <button type="submit" name="activate_user" class="btn-activate-user">Activate User</button>
                        <button type="submit" name="activate_user" class="btn-cancel-subscription" style="margin-left: 10px">Delete this User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
