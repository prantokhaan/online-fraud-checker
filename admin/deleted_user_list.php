<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deleted User List</title>
    <link rel="stylesheet" href="./css/admin_sidebar.css">
    <link rel="stylesheet" href="./css/all_user_list.css">
    <link rel="icon" href="../images/favicon.png">
</head>
<body>
    <!-- Include the admin sidebar -->
    <?php include 'admin_sidebar.php'; ?>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            <div class="title pb-4">
                <h2>Deleted User List</h2>
            </div>
            <table class="user-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Plan</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Include the database connection file
                    include '../database/db.php';

                    // Query to fetch all deleted users
                    $query = "SELECT id, fullName, subscriberStatus, accountStatus, registerAs FROM deletedUser";

                    // Execute the query
                    $result = $conn->query($query);

                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['fullName'] . "</td>";
                            echo "<td>" . $row['subscriberStatus'] . "</td>";
                            echo "<td>" . $row['registerAs'] . "</td>";
                            echo "<td>" . $row['accountStatus'] . "</td>";
                            echo "<td><a href='view_deleted_user.php?id=" . $row['id'] . "'>View User</a></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No deleted users found.</td></tr>";
                    }

                    // Close the database connection
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- End of Main Content -->
</body>
</html>
