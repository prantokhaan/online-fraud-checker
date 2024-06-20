<?php
include '../database/db.php'; // Include your database connection file

$filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';
$query = "SELECT id, courierName, userName, complainStatus FROM customerComplain";

if ($filter == 'accepted') {
    $query .= " WHERE complainStatus = 'accepted'";
} elseif ($filter == 'rejected') {
    $query .= " WHERE complainStatus = 'rejected'";
}

$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Complaint List</title>
    <link rel="stylesheet" href="./css/admin_sidebar.css">
    <link rel="stylesheet" href="./css/all_user_list.css">
    <link rel="icon" href="../images/favicon.png">
    <script>
        function confirmDelete(id) {
            if (confirm('Are you sure you want to delete this complaint?')) {
                window.location.href = 'delete_customer_complaint.php?id=' + id;
            }
        }

        function applyFilter() {
            const filter = document.getElementById('filter').value;
            window.location.href = 'all_complaints.php?filter=' + filter;
        }
    </script>
</head>
<body>
    <!-- Include the admin sidebar -->
    <?php include 'admin_sidebar.php'; ?>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            <div class="title pb-4">
                <h2>All Complaint List</h2>
                <div class="filter-option">
                    <select name="filter" id="filter">
                        <option value="all" <?php if ($filter == 'all') echo 'selected'; ?>>All Complaints</option>
                        <option value="accepted" <?php if ($filter == 'accepted') echo 'selected'; ?>>Accepted Complaints</option>
                        <option value="rejected" <?php if ($filter == 'rejected') echo 'selected'; ?>>Rejected Complaints</option>
                    </select>
                    <button class="btn" onclick="applyFilter()">Apply Filter</button>
                </div>
            </div>
            <table class="user-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Courier</th>
                        <th>User</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . htmlspecialchars($row['courierName']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['userName']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['complainStatus']) . "</td>";
                            echo "<td>
                                    <a href='view_complaint.php?id=" . $row['id'] . "'>View Complaint</a> |
                                    <button type='button' onclick='confirmDelete(" . $row['id'] . ")'>Delete</button>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No complaints found</td></tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- End of Main Content -->
</body>
</html>
