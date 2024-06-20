<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Couriers</title>
    <link rel="stylesheet" href="css/admin_sidebar.css">
    <link rel="stylesheet" href="css/all_user_list.css">
    <link rel="stylesheet" href="css/all_courier_list.css">
    <!-- Favicon  -->
    <link rel="icon" href="../images/favicon.png">
</head>
<body>
    <?php include 'admin_sidebar.php'; ?>
    <div class="main-content">
        <div class="title">
            <h2>Courier List</h2>
        </div>
        <table class="user-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Courier Name</th>
                    <th>Courier Image</th>
                    <th>Actions</th> <!-- Added actions column -->
                </tr>
            </thead>
            <tbody>
                <?php
                include '../database/db.php';

                $query = "SELECT id, courierName FROM courierAccount";
                $result = $conn->query($query);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . htmlspecialchars($row['courierName']) . "</td>";
                        echo "<td><img src='../courier/images/" . htmlspecialchars($row['courierName']) . ".png' alt='Courier Image' width='100'></td>";
                        echo "<td>";
                        echo "<button class='edit-btn' onclick=\"window.location.href='edit_courier.php?id=" . $row['id'] . "'\">Edit</button>";
                        echo "<button class='delete-btn' onclick=\"confirmDelete(" . $row['id'] . ", '" . htmlspecialchars($row['courierName']) . "')\">Delete</button>";
                        echo "<button class='edit-image-btn' onclick=\"window.location.href='edit_image.php?id=" . $row['id'] . "&name=" . htmlspecialchars($row['courierName']) . "'\">Edit Image</button>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No couriers found</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <script>
        function confirmDelete(id, name) {
            if (confirm("Are you sure you want to delete this courier account?")) {
                window.location.href = 'delete_courier.php?id=' + id + '&name=' + name;
            }
        }
    </script>
</body>
</html>
