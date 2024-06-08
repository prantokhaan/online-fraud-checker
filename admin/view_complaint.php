<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Complaint</title>
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
            <h2>View Complaint</h2>
            <div class="user-info">
                <div class="info-item">
                    <label>Name:</label>
                    <span>User's Name</span>
                </div>
                <div class="info-item">
                    <label>Email:</label>
                    <span>user@example.com</span>
                </div>
                <div class="info-item">
                    <label>Phone:</label>
                    <span>123-456-7890</span>
                </div>
                <div class="info-item">
                    <label>Age:</label>
                    <span>25</span>
                </div>
                <div class="info-item">
                    <label>Address:</label>
                    <span>123 Main Street, City, Country</span>
                </div>
                <div class="info-item">
                    <label>Username:</label>
                    <span>username123</span>
                </div>
                <div class="info-item">
                    <label>Subscriber:</label>
                    <span>NO</span>
                </div>
                <div class="action-buttons">
                    <button class="btn-cancel-subscription">Approve</button>
                    <button class="btn-ban-user">Delete</button>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
