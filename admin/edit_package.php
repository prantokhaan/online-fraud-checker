<?php
include '../database/db.php'; // Include your database connection file

// Initialize variables to store input values and messages
$id = $packageName = $price = $message = "";

// Check if the ID is provided
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Fetch package details from the database
    $query = "SELECT * FROM pricing WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $package = $result->fetch_assoc();
        $packageName = $package['packageName'];
        $price = $package['price'];
    } else {
        $message = "Package not found!";
    }
    
    $stmt->close();
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $id = $_POST["id"];
    $packageName = $_POST["packageName"];
    $price = $_POST["price"];

    // Update the package details in the database
    $query = "UPDATE pricing SET packageName = ?, price = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssi", $packageName, $price, $id);

    if ($stmt->execute()) {
        $message = "Package updated successfully!";
        header("Location: view_packages.php?message=" . urlencode($message));
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
    <title>Edit Package</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/admin_sidebar.css">
    <link rel="icon" href="../images/favicon.png">
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
            <h2>Edit Package</h2>
            <form method="POST" action="edit_package.php">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                <div class="form-group">
                    <label for="packageName">Package Name</label>
                    <input type="text" class="form-control" id="packageName" name="packageName" value="<?php echo htmlspecialchars($packageName); ?>" required>
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" class="form-control" id="price" name="price" value="<?php echo htmlspecialchars($price); ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Update Package</button>
            </form>
            <?php if ($message): ?>
                <div class="message"><?php echo htmlspecialchars($message); ?></div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
