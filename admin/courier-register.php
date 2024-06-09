<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Courier</title>
    <link rel="stylesheet" href="./css/courier-register.css">
    <link rel="stylesheet" href="./css/admin_sidebar.css">
    <link rel="icon" href="../images/favicon.png">
</head>
<body>
    <?php include './admin_sidebar.php'; ?>
    <div class="main-content">
        <h1>Register Courier</h1>
        <form action="./process_courier_register.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="courierName">Courier Name:</label>
                <input type="text" id="courierName" name="courierName" required>
            </div>
            <div class="form-group">
                <label for="courierPassword">Courier Password:</label>
                <input type="password" id="courierPassword" name="courierPassword" required>
            </div>
            <div class="form-group">
                <label for="image">Courier Logo:</label>
                <input type="file" id="image" name="image" accept="image/*" required>
            </div>
            <button type="submit" class="submit-btn">Register</button>
        </form>
    </div>
</body>
</html>