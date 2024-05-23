<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/profile.css">
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="icon" href="../images/favicon.png">
</head>
<body>
    <!-- Include the sidebar using PHP -->
    <?php include '../shared/sidebar.php'; ?>
    
    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            <h2>User Profile</h2>
            <div class="user-info">
                <div class="form-group">
                    <label>Full Name:</label>
                    <span>Ismatul Islam Pranto</span>
                </div>
                <div class="form-group">
                    <label>Age:</label>
                    <span>18</span>
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <span>prantokhaan@gmail.com</span>
                </div>
                <div class="form-group">
                    <label>Address:</label>
                    <span>Dhaka</span>
                </div>
                <!-- Add more fields as needed -->
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
