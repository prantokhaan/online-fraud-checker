<?php
include '../database/db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $courierName = $_POST['courierName'];
    $courierPassword = $_POST['courierPassword'];
    $oldCourierName = $_POST['oldCourierName'];

    // Update the courier account in the database
    $stmt = $conn->prepare("UPDATE courierAccount SET courierName = ?, courierPassword = ? WHERE id = ?");
    $stmt->bind_param("ssi", $courierName, $courierPassword, $id);
    if ($stmt->execute()) {
        // Check if the courier name has changed
        if ($courierName !== $oldCourierName) {
            // Rename the image file
            $oldImage = "../courier/images/" . $oldCourierName . ".png";
            $newImage = "../courier/images/" . $courierName . ".png";
            if (file_exists($oldImage)) {
                rename($oldImage, $newImage);
            }
        }
        echo "<script>
            alert('Courier account updated successfully.');
            window.location.href = 'all_courier_list.php';
        </script>";
    } else {
        echo "<script>
            alert('There was an error updating the courier account. Please try again.');
            window.location.href = './all_courier_list.php';
        </script>";
    }

    $stmt->close();
    $conn->close();
} else {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT courierName, courierPassword FROM courierAccount WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($courierName, $courierPassword);
    $stmt->fetch();
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Courier</title>
    <link rel="stylesheet" href="css/edit_pages.css">
    <link rel="stylesheet" href="css/admin_sidebar.css">
    <link rel="icon" href="../images/favicon.png">
</head>
<body>
    <?php include 'admin_sidebar.php'; ?>
    <div class="main-content">
        <h2>Edit Courier</h2>
        <form action="edit_courier.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="oldCourierName" value="<?php echo htmlspecialchars($courierName); ?>">
            <div class="form-group">
                <label for="courierName">Courier Name:</label>
                <input type="text" id="courierName" name="courierName" value="<?php echo htmlspecialchars($courierName); ?>" required>
            </div>
            <div class="form-group">
                <label for="courierPassword">Courier Password:</label>
                <input type="text" id="courierPassword" name="courierPassword" value="<?php echo htmlspecialchars($courierPassword); ?>" required>
            </div>
            <button type="submit" class="btn">Save Changes</button>
        </form>
    </div>
</body>
</html>
