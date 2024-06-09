<?php
include '../database/db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $courierName = $_POST['courierName'];
    $image = $_FILES['newImage'];

    // Get the file extension
    $imageFileType = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));

    // Allow certain file formats
    $allowedFormats = array("jpg", "jpeg", "png", "gif");

    if (in_array($imageFileType, $allowedFormats)) {
        $uploadDir = '../courier/images/';
        $uploadFile = $uploadDir . $courierName . '.png';

        if (move_uploaded_file($image['tmp_name'], $uploadFile)) {
            echo "<script>
                alert('Image updated successfully.');
                window.location.href = 'all_courier_list.php';
            </script>";
        } else {
            echo "<script>
                alert('Failed to upload image.');
                window.location.href = 'all_courier_list.php';
            </script>";
        }
    } else {
        echo "<script>
            alert('Invalid file format. Only JPG, JPEG, PNG, and GIF files are allowed.');
            window.location.href = 'edit_image.php?id=$id';
        </script>";
    }
} else {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT courierName FROM courierAccount WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($courierName);
    $stmt->fetch();
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Courier Image</title>
    <link rel="stylesheet" href="css/edit_pages.css">
    <link rel="stylesheet" href="css/admin_sidebar.css">
    <link rel="icon" href="../images/favicon.png">
</head>
<body>
    <?php include 'admin_sidebar.php'; ?>
    <div class="main-content">
        <h2>Edit Image</h2>
        <form action="edit_image.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="courierName" value="<?php echo htmlspecialchars($courierName); ?>">
            <div class="form-group">
                <label for="newImage">Select New Image:</label>
                <input type="file" id="newImage" name="newImage" accept=".jpg, .jpeg, .png, .gif" required>
            </div>
            <button type="submit" class="btn">Upload</button>
        </form>
    </div>
</body>
</html>
