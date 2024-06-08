<?php
include '../database/db.php'; // Include your database connection file

// Initialize variables to store input values and messages
$packageName = $price = $message = "";

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $packageName = $_POST["packageName"];
    $price = $_POST["price"];

    // Insert the data into the pricing table
    $query = "INSERT INTO pricing (packageName, price) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $packageName, $price);

    if ($stmt->execute()) {
        $message = "Pricing package added successfully!";
    } else {
        $message = "Error: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Pricing Package</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/admin_sidebar.css">
    <style>
        .main-content {
            margin-left: 280px;
            padding: 20px;
        }
        .form-container {
            max-width: 600px;
            margin: auto;
            padding: 30px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            background: #f9f9f9;
            border-radius: 8px;
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-container .form-group {
            margin-bottom: 15px;
        }
        .form-container .btn {
            width: 100%;
        }
        .message {
            text-align: center;
            margin-top: 20px;
            font-size: 1.2em;
        }
    </style>
</head>
<body>
    <?php include 'admin_sidebar.php'; ?>
    <div class="main-content">
        <div class="form-container">
            <h2>Add Pricing Package</h2>
            <form method="POST" action="add_pricing.php">
                <div class="form-group">
                    <label for="packageName">Package Name</label>
                    <input type="text" class="form-control" id="packageName" name="packageName" required>
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" class="form-control" id="price" name="price" required>
                </div>
                <button type="submit" class="btn btn-primary">Add Package</button>
            </form>
            <?php if ($message): ?>
                <div class="message"><?php echo htmlspecialchars($message); ?></div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
