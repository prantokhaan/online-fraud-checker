<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="../css/change_password.css">
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="icon" href="../images/favicon.png">
</head>
<body>
    <!-- Include the sidebar using PHP -->
    <?php include '../shared/sidebar.php'; ?>

    <!-- Change Password Form -->
    <div class="main-content">
        <div class="change-password-container">
            <h2>Change Password</h2>
            <form action="change_password.php" method="post">
                <div class="form-group">
                    <label for="email">Your Email:</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label for="oldPassword">Old Password:</label>
                    <input type="password" id="oldPassword" name="oldPassword" class="form-control" placeholder="Enter your old password" required>
                </div>
                <div class="form-group">
                    <label for="newPassword">New Password:</label>
                    <input type="password" id="newPassword" name="newPassword" class="form-control" placeholder="Enter your new password" required>
                </div>
                <div class="form-group">
                    <label for="confirmNewPassword">Confirm New Password:</label>
                    <input type="password" id="confirmNewPassword" name="confirmNewPassword" class="form-control" placeholder="Confirm your new password" required>
                </div>
                <button type="submit" class="btn btn-primary">Change Password</button>
            </form>
        </div>
    </div>
    <!-- End of Change Password Form -->
</body>
</html>
