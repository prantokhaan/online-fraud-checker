<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../database/db.php'; // Include your database connection file

    $courierName = htmlspecialchars($_POST['courierName']);
    $courierPassword = htmlspecialchars($_POST['courierPassword']);
    $image = $_FILES['image'];

    // Check if courierName already exists
    $stmt = $conn->prepare("SELECT id FROM courierAccount WHERE courierName = ?");
    $stmt->bind_param("s", $courierName);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Courier name already exists
        echo "<script>
            alert('Courier name already exists. Please choose a different name.');
            window.location.href = 'register.php';
        </script>";
        $stmt->close();
    } else {
        // Proceed with registration
        $stmt->close();

        $uploadDir = '../courier/images/';
        $uploadFile = $uploadDir . $courierName . '.png';

        // Move uploaded file
        if (move_uploaded_file($image['tmp_name'], $uploadFile)) {
            // Insert courierName and courierPassword into the database
            $stmt = $conn->prepare("INSERT INTO courierAccount (courierName, courierPassword) VALUES (?, ?)");
            $stmt->bind_param("ss", $courierName, $courierPassword);
            if ($stmt->execute()) {
                echo "<script>
                    alert('Courier account registered successfully.');
                    window.location.href = './all_courier_list.php';
                </script>";
            } else {
                echo "<script>
                    alert('There was an error registering the courier account. Please try again.');
                    window.location.href = 'register.php';
                </script>";
            }
            $stmt->close();
        } else {
            echo "<script>
                alert('Failed to upload image.');
                window.location.href = 'register.php';
            </script>";
        }
    }

    $conn->close();
}
?>
